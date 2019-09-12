beforeEach(function () {
  cy.exec('php artisan user:setLocale en');
  cy.visit('/');
  cy.wait(2000);
  cy.url().should('contain', '/login');
  cy.get(':nth-child(2) > .form-control').type('test')
  cy.get(':nth-child(3) > .form-control').type('123456')
  cy.contains('Sign In').click();
  cy.get('.name').click();
  cy.get('a[data-target="#account-info"]').click();
  cy.get('.modal-content form').invoke('attr', 'noValidate','true');
})
describe('update profile settings',function(){
  it('updates default language successfully', function () {
    cy.get('#inputState1> option[value="dark"]').invoke('attr', 'selected',true);
    cy.get('#inputState2> option[value="ar"]').invoke('attr', 'selected',true);
    cy.get('.modal-footer > .btn-primary').click();
    cy.server();
    cy.request('get','/api/user/test').then((response)=>{
      expect(response.body).to.have.property('theme', 'dark')
      expect(response.body).to.have.property('lang', 'ar')
    });
  })
  it('fails to edit user_name and full_name',function(){
    cy.get('.modal-body > :nth-child(1) > :nth-child(1) > .form-control').invoke('attr', 'disabled',false);
    cy.get('.modal-body > :nth-child(1) > :nth-child(2) > .form-control').invoke('attr', 'disabled',false);
    cy.get('.modal-body > :nth-child(1) > :nth-child(1) > .form-control').clear().type('admin2');
    cy.get('.modal-body > :nth-child(1) > :nth-child(2) > .form-control').clear().type('admin2');
    cy.get('.modal-footer > .btn-primary').click();
    cy.server();
    cy.request('get','/api/user/test').then((response)=>{
      expect(response.body).to.have.property('user_name', 'test')
      expect(response.body).to.have.property('full_name', 'test')
    });
  })
  it('checks password length',function(){
    cy.get('#password').clear().type('123');
    cy.get('#password_confirmation').clear().type('123');
    cy.get('.modal-footer > .btn-primary').click();
    cy.get('.error').should('contain','The password must be at least 6 characters.');
  })
  it('checks password confirmation',function(){
    cy.get('#password').clear().type('123456');
    cy.get('#password_confirmation').clear().type('12345');
    cy.get('.modal-footer > .btn-primary').click();
    cy.get('.error').should('contain','The password confirmation does not match.');
  })
  it('checks cancel button',function(){
    cy.get('#inputState1> option[value="light"]').invoke('attr', 'selected',true);
    cy.get('#inputState2> option[value="ar"]').invoke('attr', 'selected',true);
    cy.get('.btn-secondary').click();
    cy.server();
    cy.request('get','/api/user/test').then((response)=>{
      expect(response.body).to.have.property('lang', 'en')
      expect(response.body).to.have.property('theme', 'dark')
    });
  })
  it('checks password update button',function(){
    cy.get('#password').clear().type('123456789');
    cy.get('#password_confirmation').clear().type('123456789');
    cy.get('.modal-footer > .btn-primary').click();
    cy.get('.name').click();
    cy.get('[href="javascript:void(0);"]').click();
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456789')
    cy.contains('Sign In').click();
    cy.url();
    cy.get('.name').should('be.visible');
  })
  after(function(){
    cy.exec('php artisan migrate:refresh');
    cy.exec('php artisan db:seed');
  });
});
