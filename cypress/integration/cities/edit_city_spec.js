describe('Edit City test', function () {
    before(function(){
      cy.exec('php artisan governorate:demo_faker');
      cy.exec('php artisan city:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission cities.index');
        cy.exec('php artisan user:add_permission cities.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/cities');
        cy.get(':nth-child(5) > .btn').click();
        cy.url().should('contain','/master-data/cities/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('form > :nth-child(3) > .form-group > .form-control > :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/cities/1000/edit');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('Governorate is Required').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('form > :nth-child(3) > .form-group > .form-control > option[value=10001]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('.card-body input[name="ar_name"]').clear().type('الاسكندريه');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','City Updated')
    cy.server();
    cy.request('get','/api/city/Alex').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Alex')
      expect(response.body).to.have.property('gov_id', 10001)
      expect(response.body).to.have.property('ar_name', 'الاسكندريه')
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission cities.edit");
    cy.visit('/master-data/cities');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/cities/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission cities.index");

    cy.visit('/master-data/cities',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
