Cypress.Commands.add("login_bb", (username = 'test', password = '123456') => {
    cy.get('input[name=user_name]').type(username);
    cy.get('input[name=password]').type(password);
    cy.contains('Sign In').click();
});

Cypress.Commands.add("login_out_bb", () => {
    cy.get('#logout').submit();
});

Cypress.Commands.add("open_app_bb", ($url) => {
    cy.visit($url);
});
Cypress.Commands.add('assert_success_login_bb',function(username = 'test'){
    cy.get('nav span.name').should('contain',username);
});

Cypress.Commands.add('assert_fail_login_bb',function(){
    cy.get('li').should('contain', 'Invalid User name or password');
});
