beforeEach(function () {
    cy.visit('http://127.0.0.1:8000');
    cy.wait(2000);
    cy.url().should('contain', '/login');
})
describe('Login', function () {
    it('shows error for both required fields', function () {
        cy.contains('Sign In').click();
        cy.url().should('contain', '/login');
    })
    it('empty password field', function () {
        cy.get(':nth-child(2) > .form-control').type('admin')
        cy.contains('Sign In').click();
        cy.url().should('contain', '/login');
    })

    it('empty user name field', function () {
        cy.get(':nth-child(3) > .form-control').type('666666');
        cy.contains('Sign In').click();
        cy.url().should('contain', '/login');
    })

    it('valid user name and invalid password', function () {
        cy.get(':nth-child(2) > .form-control').type('admin')
        cy.get(':nth-child(3) > .form-control').type('666666')
        cy.contains('Sign In').click()
        cy.url().should('contain', '/login');
        cy.get('li').should('contain', 'These credentials do not match our records.')
    })
    it('invalid user name and invalid password', function () {
        cy.get(':nth-child(2) > .form-control').type('amin')
        cy.get(':nth-child(3) > .form-control').type('666666')
        cy.contains('Sign In').click()
        cy.url().should('contain', '/login');
        cy.get('li').should('contain', 'These credentials do not match our records.')
    })

    it('Successful Login with valid user name and valid password', function () {
        cy.get(':nth-child(2) > .form-control').type('admin')
        cy.get(':nth-child(3) > .form-control').type('123456')
        cy.contains('Sign In').click()
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/')
        cy.get('.user > button').click();
        cy.get('[href="javascript:void(0);"]').click();
        cy.url().should('contain', '/login');
    })

    it('password is astrisks', function () {
        cy.get(':nth-child(3) > .form-control').invoke('attr', 'type').should('contain', 'password')
    })


})



