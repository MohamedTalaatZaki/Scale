beforeEach(function () {
    cy.exec("php artisan user:add_permission centers.index");
    cy.exec("php artisan user:add_permission centers.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/centers');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/centers/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan governorate:demo_faker');
  cy.exec('php artisan city:edit_faker');
  cy.exec('php artisan user:setLocale en');
});
describe('Create Center', function () {
  it('checks required fields', function () {
    cy.get('.card-body .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/centers/create');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('City is Required').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('form > :nth-child(2) > .form-group > .form-control option[value="1000"]').invoke('attr', 'selected',true);
    cy.get('input[name="is_active"]').invoke('attr', 'checked',false);
    cy.get('input[name="is_active"]').invoke('attr', 'value',0);
    cy.get('.card-body input[name="en_name"]').type('Cairo');
    cy.get('.card-body input[name="ar_name"]').type('القاهره');
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','Center created successfully')
    cy.server();
    cy.request('get','/api/center/cairo').then((response)=>{
      console.log(response);
      expect(response.body).to.have.property('en_name', 'Cairo')
      expect(response.body).to.have.property('is_active', 0)
      expect(response.body).to.have.property('ar_name', 'القاهره')
      expect(response.body).to.have.property('city_id', 1000)
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission centers.create");
    cy.visit('/master-data/centers');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/centers/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission centers.index");
    cy.visit('/master-data/centers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
