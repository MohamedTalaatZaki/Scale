beforeEach(function () {
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.visit('/security/queue');
    cy.wait(2000);
})
before(function(){
  cy.exec("php artisan migrate:refresh && php artisan db:seed");
  cy.exec('php artisan item_group:demo_faker');
  cy.exec('php artisan item:demo_faker');
  cy.exec('php artisan supplier:demo_faker');
  cy.exec('php artisan user:setLocale en');
  cy.exec('php artisan qc_test:fake_qc_details');
  cy.exec('php artisan test:create_truck_arrival');
  cy.exec('php artisan sample_test:create_sample_test');
});
describe('checks order of listed trucks', function () {
  it('checks rejected status of truck visibility',function(){
      cy.get('h3').contains('# 1').should('not.exist')
  })
  it('checks accepted status of truck visibility',function(){
      cy.exec('php artisan truck:update_status accepted');
      cy.visit('/qc/arrived-trucks');
      cy.visit('/security/queue');
      cy.get('h3').contains('# 1').should('be.visible')
  })

  it('checks finished status of truck visibility',function(){
    cy.exec('php artisan truck:update_type 2');
    cy.exec('php artisan truck:update_status accepted');
    cy.visit('/security/queue');
    cy.get('h3').contains('# 1').should('be.visible')
  })
  it('checks scrap status of truck visibility',function(){
    cy.exec('php artisan truck:update_type 3');
    cy.exec('php artisan truck:update_status waiting');
    cy.visit('/security/queue');
    cy.get('h3').contains('# 1').should('be.visible')
  })
})
