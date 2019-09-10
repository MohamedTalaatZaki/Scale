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
        cy.exec('php artisan test:delete_user');
        cy.exec('php artisan test:create_user');
        cy.exec('php artisan test:delete_user2');
    })

    afterEach(function () {
        cy.exec('php artisan test:delete_user');
    })

    it('check nullable values', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('input[name="employee_code"]').clear();
        cy.get('input[name="email"]').clear();
        cy.get('select[name=role_id]').select('Select Role');
        cy.contains('Save').click();
        cy.contains('User Updated Success').should('be.visible');
    })




})
