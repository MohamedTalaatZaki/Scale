beforeEach(function () {
    cy.exec("php artisan user:add_permission item-types.index");
    cy.exec("php artisan user:add_permission item-types.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/items/item-types');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/items/item-types/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('Create Item Type', function () {
  it('checks required fields', function () {
    cy.get('.card-body .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/items/item-types/create');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').type('Cairo');
    cy.get('.card-body input[name="ar_name"]').type('القاهره');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Item Type Created')
    cy.server();
    cy.request('get','/api/item_type/cairo').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Cairo')
      expect(response.body).to.have.property('ar_name', 'القاهره')
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission item-types.create");
    cy.visit('/master-data/items/item-types');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/items/item-types/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission item-types.index");
    cy.visit('/master-data/items/item-types',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
