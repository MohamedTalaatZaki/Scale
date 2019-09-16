beforeEach(function () {
    cy.exec("php artisan user:add_permission items.index");
    cy.exec("php artisan user:add_permission items.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/items/items');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/items/items/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan item_group:demo_faker');
  cy.exec('php artisan item:edit_faker');
  cy.exec('php artisan user:setLocale en');
});
describe('Create Item', function () {
  it('checks required fields', function () {
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/items/items/create');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('Item group is required').should('be.visible');
    cy.contains('SAP code is required').should('be.visible');
    cy.contains('Item Type is required').should('be.visible');
  })
  it('checks unique fields', function () {
    cy.get('.card-body input[name="sap_code"]').type('666');
    cy.get('.card-body input[name="en_name"]').type('Alex');
    cy.get('.card-body input[name="ar_name"]').type('الاسكندريه');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#item_type_id option[value="2"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/items/items/create');
    cy.get('.error').should('contain','SAP code is duplicated')
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="sap_code"]').type('wwwwww');
    cy.get('.card-body input[name="en_name"]').type('Cairo');
    cy.get('.card-body input[name="ar_name"]').type('القاهره');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#item_type_id option[value="2"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Item Created Success')
    cy.server();
    cy.request('get','/api/item/wwwwww').then((response)=>{
      console.log(response);
      expect(response.body).to.have.property('en_name', 'Cairo')
      expect(response.body).to.have.property('sap_code', 'wwwwww')
      expect(response.body).to.have.property('is_active', 1)
      expect(response.body).to.have.property('item_type_id', 2)
      expect(response.body).to.have.property('item_group_id', 10001)
      expect(response.body).to.have.property('ar_name', 'القاهره')
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission items.create");
    cy.visit('/master-data/items/items');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/items/items/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission items.index");
    cy.visit('/master-data/items/items',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
