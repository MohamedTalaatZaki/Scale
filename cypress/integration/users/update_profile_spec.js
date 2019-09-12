beforeEach(function () {
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('update profile settings',function(){
  it('updates default language successfully', function () {
    cy.get('.name').click();
    cy.get('a[data-target="#account-info"]').click();
    cy.get('.modal-content form').invoke('attr', 'noValidate','true');
    cy.get('#inputState1> option[value="dark"]').invoke('attr', 'selected',true);
    cy.get('#inputState2> option[value="ar"]').invoke('attr', 'selected',true);
    cy.get('.modal-footer > .btn-primary').click();
    cy.server();
    cy.request('get','/api/user/test').then((response)=>{
      expect(response.body).to.have.property('theme', 'dark')
      expect(response.body).to.have.property('lang', 'ar')
    });
  })
});
