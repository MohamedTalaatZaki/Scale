beforeEach(function () {
    cy.exec("php artisan user:add_permission suppliers.index");
    cy.exec("php artisan user:add_permission suppliers.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/suppliers');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/suppliers/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan item_group:demo_faker');
  cy.exec('php artisan item:demo_faker');
  cy.exec('php artisan user:setLocale en');
});
describe('Create Supplier', function () {
  it('checks required fields', function () {
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/suppliers/create');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('The sap code field is required.').should('be.visible');
  })
  it('checks Nullable fields',function(){
    cy.get('.card-body input[name="sap_code"]').type('wwwwww');
    cy.get('.card-body input[name="en_name"]').type('Cairo');
    cy.get('.card-body input[name="ar_name"]').type('القاهره');
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Supplier Created Success')
    cy.server();
    cy.request('get','/api/supplier/cairo').then((response)=>{
      console.log(response);
      expect(response.body).to.have.property('en_name', 'Cairo')
      expect(response.body).to.have.property('sap_code', 'wwwwww')
      expect(response.body).to.have.property('is_active', 1)
      expect(response.body).to.have.property('ar_name', 'القاهره')
    });
  })
  it('checks All fields',function(){
    cy.get('.card-body input[name="sap_code"]').type('qqqqqq');
    cy.get('.card-body input[name="en_name"]').type('Alex');
    cy.get('.card-body input[name="ar_name"]').type('الاسكندريه');
    cy.get('#items option[value="1000"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Supplier Created Success')
    cy.server();
    cy.request('get','/api/supplier/Alex').then((response)=>{
      console.log(response);
      expect(response.body).to.have.property('en_name', 'Alex')
      expect(response.body).to.have.property('sap_code', 'qqqqqq')
      expect(response.body).to.have.property('is_active', 1)
      expect(response.body.items[0]).to.have.property('id', 1000)
      expect(response.body).to.have.property('ar_name', 'الاسكندريه')
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission suppliers.create");
    cy.visit('/master-data/suppliers');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/suppliers/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission suppliers.index");
    cy.visit('/master-data/suppliers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
