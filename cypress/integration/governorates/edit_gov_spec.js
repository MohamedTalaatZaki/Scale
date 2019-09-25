describe('Edit Governorate test', function () {
    before(function(){
      cy.exec('php artisan governorate:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission governorates.index');
        cy.exec('php artisan user:add_permission governorates.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/governorates?page=2');
        cy.get('tbody > :nth-child(3) > :nth-child(4) > .btn').click();
        cy.url().should('contain','/master-data/governorates/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/governorates/1000/edit');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
  })

  it('checks unique fields',function(){
    cy.exec('php artisan governorate:demo_faker');
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('.card-body input[name="ar_name"]').clear().type('السكندرية');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','Governorate English Name is duplicated')
    cy.contains('Governorate Arabic Name is duplicated').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').clear().type('Assiut');
    cy.get('.card-body input[name="ar_name"]').clear().type('اسيوط');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Governorate Updated')
    cy.server();
    cy.request('get','/api/governorate/Assiut').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Assiut')
      expect(response.body).to.have.property('ar_name', 'اسيوط')
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission governorates.edit");
    cy.visit('/master-data/governorates');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/governorates/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission governorates.index");

    cy.visit('/master-data/governorates',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
