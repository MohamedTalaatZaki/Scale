beforeEach(function () {
    cy.exec("php artisan user:add_permission governorates.index");
    cy.exec("php artisan user:add_permission governorates.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/governorates');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/governorates/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('Create Governorate', function () {
  it('checks required fields', function () {
    cy.get('.card-body .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/governorates/create');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
  })

  it('checks unique fields',function(){
    cy.exec('php artisan governorate:create_faker');
    cy.get('.card-body input[name="en_name"]').type('Alexandria');
    cy.get('.card-body input[name="ar_name"]').type('الإسكندرية');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','Governorate English Name is duplicated')
    cy.contains('Governorate Arabic Name is duplicated').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').type('Assiut');
    cy.get('.card-body input[name="ar_name"]').type('اسيوط');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Governorate Created')
    cy.server();
    cy.request('get','/api/governorate/Assiut').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Assiut')
      expect(response.body).to.have.property('ar_name', 'اسيوط')
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission governorates.create");
    cy.visit('/master-data/governorates');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/governorates/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission governorates.index");
    cy.visit('/master-data/governorates',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
