beforeEach(function () {
    cy.exec("php artisan user:add_permission qc-test-headers.index");
    cy.exec("php artisan user:add_permission qc-test-headers.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('#collapseQcTest > .list-unstyled > li > .sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/qc-test-headers');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/qc-test-headers/create');
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('Create QC Test', function () {
  it('checks required fields', function () {
    cy.get('select[name="details[0][qc_element_id]"]').should('be.visible')
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission qc-test-headers.create");
    cy.visit('/master-data/qc-test-headers');
    cy.get('.button-container > a > button').should('not.be.visible');
    cy.visit('/master-data/qc-test-headers/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission qc-test-headers.index");
    cy.visit('/master-data/qc-test-headers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/');
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
