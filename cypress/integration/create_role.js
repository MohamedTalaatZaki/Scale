describe('create roles test', function () {


    beforeEach(function () {
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('admin');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.exec('php artisan test:create_user');
    })

    it('check mandatory and unique fields', function () {
        cy.contains('Master Data').click();
        cy.get('.sidebar-sub sidebar-sub-roles').click();
        cy.contains('Create').click();
        cy.get('.form-control').type('');
        cy.url().should('contain','/roles/create');
        cy.get('.form-control').type('new');
        cy.contains('Role Created').should('be visible');

        //cy.exec('php artisan test:delete_role_new');

    })





})
