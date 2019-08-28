describe('Login',function(){
  it('shows error for required fields',function(){
    cy.visit('/');
    cy.url().should('contain', '/login');
    cy.get('.btn').click();
    cy.url().should('contain', '/login');
  })
  it('has false email',function(){
    cy.visit('/');
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('amin')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.get('.btn').click()
    cy.url().should('contain', '/login');
    cy.get('li').should('contain','These credentials do not match our records.')
  })
  it('has false password',function(){
    cy.visit('/');
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('admin')
    cy.get(':nth-child(3) > .form-control').type('12345')
    cy.get('.btn').click()
    cy.url().should('contain', '/login');
    cy.get('li').should('contain','These credentials do not match our records.')
  })
  it('Successful Login',function(){
    cy.visit('/');
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('admin')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.get('.btn').click()
    cy.url().should('contain', '/');
    cy.get('.user > button').click();
    cy.get('[href="http://dev.juhayna/logout"]').click();  cy.url().should('contain', '/logout');
  })
})
