describe('Edit Users test', function () {


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

    it('check default inactive status', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('.custom-switch-btn').should('have.css', 'border', '1px solid rgb(215, 215, 215)');
    })

    it('matching password confirmation', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('.card-body input[name=password]').type('123456');
        cy.get('.card-body input[name=password_confirmation]').type('123459');
        cy.contains('Save').click();
        cy.contains('The password confirmation does not match.').should('be.visible');
    })
    it('check password lenghth', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('.card-body input[name=password]').type('12345');
        cy.get('.card-body input[name=password_confirmation]').type('12345');
        cy.contains('Save').click();
        cy.contains('The password must be at least 6 characters.').should('be.visible');
    })
    it('required fields check', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('input[name="full_name"]').should('have.attr', 'required');
        cy.get('input[name="user_name"]').should('have.attr', 'required');
    })
    it('default language check', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('select[name="lang"]').should('have.value', 'ar');
    })
    it('check user name length', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1000/edit']").click();
        cy.get('.card-body input[name=user_name]').clear().type('t');
        cy.contains('Save').click();
        console.log(cy.url())
        cy.contains('The user name must be at least 4 characters.').should('be.visible');
    })
    it('unique fields check', function () {
        cy.exec('php artisan test:create_user2');
        cy.contains('Master Data').click();
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href|='http://127.0.0.1:8000/master-data/users/1001/edit']").click();
        cy.get('.card-body input[name=user_name]').clear().type('test');
        cy.contains('Save').click();
        cy.contains('The user name has already been taken.').should('be.visible');
        cy.get('.card-body input[name=email]').clear().type('test@test.com');
        cy.contains('Save').click();
        cy.contains('The email has already been taken.').should('be.visible');
        cy.exec('php artisan test:delete_user2');
    })

})
