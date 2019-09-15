describe('List roles', function () {
  before(function(){
    cy.exec("php artisan role:faker");
    cy.exec("php artisan user:add_permission roles.index");
  });
  beforeEach(function(){
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click()
    cy.wait(2000);
    cy.visit('/master-data/roles');
  });
  it('visits roles lists',function(){
    cy.get(':nth-child(3) > :nth-child(8) > .btn').should('not.exist')
    cy.get('.pagination').should('be.visible');
  })
  after(function(){
    cy.exec("php artisan user:remove_permission roles.index");
    cy.visit('/master-data/roles',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403');
    cy.visit('/');
    cy.get('.user > button').click();
    cy.get('[href="javascript:void(0);"]').click();
    cy.url().should('contain', '/login');
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
