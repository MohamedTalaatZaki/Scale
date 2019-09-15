describe('Edit Item Type test', function () {
    before(function(){
      cy.exec('php artisan item_type:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission item-types.index');
        cy.exec('php artisan user:add_permission item-types.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/items/item-types/');
        cy.get('tbody > :nth-child(1) > :nth-child(4) > .btn').click();
        cy.url().should('contain','/master-data/items/item-types/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/items/item-types/1000/edit');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').clear().type('Cairo');
    cy.get('.card-body input[name="ar_name"]').clear().type('القاهره');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Item Type Updated')
    cy.server();
    cy.request('get','/api/item_type/cairo').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Cairo')
      expect(response.body).to.have.property('ar_name', 'القاهره')
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission item-types.edit");
    cy.visit('/master-data/items/item-types/');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/items/item-types/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission item-types.index");

    cy.visit('/master-data/items/item-types/',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
