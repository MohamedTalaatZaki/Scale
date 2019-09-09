describe('List users', function () {
  before(function(){
    cy.exec("composer dump-autoload");
    cy.exec("php artisan db:seed --class=UsersTest");
  });
  it('visits users lists',function(){
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('admin')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click()
    cy.wait(2000);
    cy.visit('/master-data/users');
  })
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
