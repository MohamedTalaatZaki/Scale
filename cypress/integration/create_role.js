describe('create roles test', function () {
    beforeEach(function () {
        cy.exec('php artisan user:setLocale en');
        cy.exec('php artisan user:add_permission roles.index');
        cy.exec('php artisan user:add_permission roles.create');
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.exec('php artisan test:delete_role');
    })
    it('check mandatory fields', function () {
        cy.get('.iconsminds-digital-drawing').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.contains('Create').click();
        cy.get('input[name="name"]').type(' ');
        cy.contains('Save').click();
        cy.contains('Role Name is required').should('be.visible');
        cy.url().should('contain', '/roles/create');
        cy.get('input[name="name"]').type('new');
        cy.contains('Save').click();
        cy.contains('Role Created').should('be.visible');
        cy.exec('php artisan test:delete_role');

    })

    it('check Unique fields', function () {
        cy.get('.iconsminds-digital-drawing').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.contains('Create').click();
        cy.get('input[name="name"]').type('test');
        cy.contains('Save').click();
        cy.url().should('contain', '/roles/create');
        cy.contains('Role Name is duplicated').should('be.visible');
    })

    it('role with no permission access only home page', function () {
        cy.get('.iconsminds-digital-drawing').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.contains('Create').click();
        cy.get('input[name="name"]').type('new');
        cy.contains('Save').click();
        cy.contains('Role Created').should('be.visible');
        cy.exec('php artisan test:create_user_radwa');
        cy.exec('php artisan test:create_user_with_role');
        cy.get('.user > button').click();
        cy.get('[href="javascript:void(0);"]').click();
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('radwa');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.get('.iconsminds-digital-drawing').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/roles', {failOnStatusCode: false});
        cy.get('.code').should('contain', '403');
        cy.exec('php artisan test:delete_user_with_role');
        cy.exec('php artisan test:delete_user_radwa');
        cy.exec('php artisan test:delete_role');
    })

    it('ensure that the permission assigned to roles are working as expected', function () {
        cy.get('.iconsminds-digital-drawing').click();
        cy.get('.sidebar-sub.sidebar-sub-roles').click();
        cy.contains('Create').click();
        cy.get('input[name="name"]').type('new');
        cy.contains('Save').click();
        cy.contains('Role Created').should('be.visible');
        cy.exec('php artisan user:add_permission_to_new roles.index');
        cy.exec('php artisan user:add_permission_to_new roles.create');
        cy.exec('php artisan test:create_user_radwa');
        cy.exec('php artisan test:create_user_with_role');
        cy.get('.user > button').click();
        cy.get('[href="javascript:void(0);"]').click();
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('radwa');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.get('.iconsminds-digital-drawing').click();
        cy.get('.sidebar-sub > .d-inline-block').should('be.visible');
        cy.contains('البيانات الاساسية').should('be.visible');
        cy.visit('http://127.0.0.1:8000/master-data/roles');
        cy.get('a > .btn').should('be.visible');
        cy.exec('php artisan user:revoke_permission_to_new roles.create');
        cy.exec('php artisan user:revoke_permission_to_new roles.index');
        cy.exec('php artisan test:delete_user_with_role');
        cy.exec('php artisan test:delete_user_radwa');
        cy.exec('php artisan test:delete_role');
    })
    afterEach(function () {
        cy.exec('php artisan user:remove_permission roles.create');
        cy.exec('php artisan user:remove_permission roles.index');
    })
    after(function(){
      cy.exec('php artisan test:delete_role');
    })
})
