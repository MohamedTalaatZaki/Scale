describe('Edit City test', function () {
    before(function(){
      cy.exec('php artisan governorate:demo_faker');
      cy.exec('php artisan city:edit_faker');
      cy.exec('php artisan center:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission centers.index');
        cy.exec('php artisan user:add_permission centers.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/centers');
        cy.get(':nth-child(7) > .btn').click();
        cy.url().should('contain','/master-data/centers/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/centers/1000/edit');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('form > :nth-child(3) > .form-group > .form-control option[value=1000]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('input[name="is_active"]').invoke('attr', 'checked',false);
    cy.get('input[name="is_active"]').invoke('attr', 'value',0);
    cy.get('.card-body input[name="ar_name"]').clear().type('الاسكندريه');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Center updated successfully')
    cy.server();
    cy.request('get','/api/center/Alex').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Alex')
      expect(response.body).to.have.property('city_id', 1000)
      expect(response.body).to.have.property('ar_name', 'الاسكندريه')
      expect(response.body).to.have.property('is_active', 0)
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission centers.edit");
    cy.visit('/master-data/centers');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/centers/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission centers.index");

    cy.visit('/master-data/centers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
