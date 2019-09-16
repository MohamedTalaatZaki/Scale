describe('Edit roles test', function () {


    beforeEach(function () {
        cy.exec('php artisan user:add_permission roles.index');
        cy.exec('php artisan user:add_permission roles.edit');
        cy.visit('http://127.0.0.1:8000/');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.exec('php artisan test:delete_user1');
        cy.exec('php artisan test:create_user1');
        cy.exec('php artisan test:delete_role');

    })

    it('check mandatory and unique field to be empty failure', function () {
        cy.contains('Master Data').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.contains('Edit').click();
        cy.get('input[name="name"]').clear().type(' ');
        cy.contains('Save').click();
        cy.url().should('contain', '/edit');
        cy.contains('Role Name is required').should('be.visible');
    })

    it('check that non permitted pages is not accessible via URL', function () {
        cy.exec('php artisan user:remove_permission roles.index');
        cy.exec('php artisan user:remove_permission roles.edit');
        cy.visit('http://127.0.0.1:8000/');
        cy.contains('Master Data').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/roles', {failOnStatusCode: false});
        cy.get('.code').should('contain', '403');
        cy.exec('php artisan user:add_permission roles.index');
        cy.exec('php artisan user:add_permission roles.edit');
        cy.visit('http://127.0.0.1:8000/master-data/roles');
        cy.contains('Edit').should('be.visible');
    })

    it('ensure that the user can mark/unmark permissions and changes is done or not.', function () {
        cy.exec('php artisan test:create_role_testing');
        cy.exec('php artisan test:create_user_with_role');
        cy.contains('Master Data').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.get('a[href="http://127.0.0.1:8000/master-data/roles/9999/edit"]').click();
        cy.get('input[id="permission280"]').click({ force: true });
        cy.get('input[id="permission282"]').click({ force: true });
        cy.contains('Save').click();
        cy.get('.user > button').click();
        cy.get('[href="javascript:void(0);"]').click();
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('testing1');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.contains('البيانات الاساسية').click({force:true});
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.get('.btn.btn-primary.btn-sm.mb-1').should('be.visible');
        cy.exec('php artisan test:delete_role');
    })


    afterEach(function () {
        cy.exec('php artisan user:remove_permission roles.edit');
        cy.exec('php artisan user:remove_permission roles.index');
        cy.exec('php artisan test:delete_user1');
        cy.exec('php artisan test:delete_role');
    })


})
