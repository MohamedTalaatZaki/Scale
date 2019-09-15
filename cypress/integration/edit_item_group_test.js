describe('Edit item group test', function () {


    beforeEach(function () {
        cy.exec('php artisan user:add_permission item-group.index');
        cy.exec('php artisan user:add_permission item-group.edit');
        cy.visit('http://127.0.0.1:8000/');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.exec('php artisan test:delete_item_group');
        cy.exec('php artisan test:create_item_group');


    })

    it.only('check that non permitted pages is not accessible via URL', function () {
        cy.exec('php artisan user:remove_permission item-group.edit');
        cy.exec('php artisan user:remove_permission item-group.index');
        cy.visit('http://127.0.0.1:8000/');
        cy.contains('Master Data').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/items/item-group', {failOnStatusCode: false});
        cy.get('.code').should('contain', '403');
        cy.exec('php artisan user:add_permission item-group.index');
        cy.exec('php artisan user:add_permission item-group.edit');
        cy.visit('http://127.0.0.1:8000/master-data/items/item-group');
        cy.contains('Edit').should('be.visible');

    })

    it('check mandatory and unique field to be empty failure', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group/123456/edit"]').click();
        cy.get('input[name="en_name"]').clear().type(' ');
        cy.get('input[name="ar_name"]').clear().type(' ');
        cy.contains('Save').click();
        cy.url().should('contain', 'item-group/edit');
        cy.contains('English Name is required').should('be.visible');
        cy.contains('Arabic Name is required').should('be.visible');
        cy.contains('Is testable is required').should('be.visible');
    })


    it('edit item group successfully', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group/123456/edit"]').click();
        cy.get('input[name="en_name"]').clear().type('orange orange');
        cy.get('input[name="ar_name"]').clear().type('رتقال رتقال');
        cy.get('.select2-selection.select2-selection--single.form-control').click({ force: true });
        cy.contains('Save').click();
        cy.url().should('contain', '/item-group');
        cy.contains('Create').should('be.visible');

    })

    it('check cancel button functionality', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group/123456/edit"]').click();
        cy.get('input[name="en_name"]').type('​orange orange orange');
        cy.get('input[name="ar_name"]').type('رتقال رتقال رتقال');
        cy.get('.select2-selection.select2-selection--single.form-control').click({ force: true });
        cy.contains('Cancel').click({force:true});
        cy.url().should('contain', '/items/item-group');
        cy.contains('Create').should('be.visible');
    })


    afterEach(function () {
        cy.exec('php artisan user:remove_permission item-group.edit');
        cy.exec('php artisan user:remove_permission item-group.index');
        cy.exec('php artisan test:delete_item_group');
    })
    })



