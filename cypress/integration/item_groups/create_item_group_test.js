describe('create item group test', function () {


    beforeEach(function () {
        cy.exec('php artisan user:add_permission item-group.index');
        cy.exec('php artisan user:add_permission item-group.create');
        cy.visit('http://127.0.0.1:8000/');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');

    })

    it('check that non permitted pages is not accessible via URL', function () {
        cy.exec('php artisan user:remove_permission item-group.create');
        cy.exec('php artisan user:remove_permission item-group.index');
        cy.visit('http://127.0.0.1:8000/');
        cy.contains('Master Data').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/items/item-group', {failOnStatusCode: false});
        cy.get('.code').should('contain', '403');
        cy.exec('php artisan user:add_permission item-group.index');
        cy.exec('php artisan user:add_permission item-group.create');
        cy.visit('http://127.0.0.1:8000/master-data/items/item-group');
        cy.contains('Create').should('be.visible');

    })

    it('check mandatory and unique field to be empty failure', function () {
        cy.contains('Master Data').click({force:true});
       cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.contains('Create').click();
        cy.get('input[name="en_name"]').type(' ');
        cy.get('input[name="ar_name"]').type(' ');
        cy.contains('Save').click();
        cy.url().should('contain', 'item-group/create');
        cy.contains('English Name is required').should('be.visible');
        cy.contains('Arabic Name is required').should('be.visible');
        cy.contains('Is testable is required').should('be.visible');
    })


    it('create item group with only one required field not given', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.contains('Create').click();
        cy.get('input[name="en_name"]').type('orange orange');
        cy.get('input[name="ar_name"]').type('رتقال رتقال');
        cy.contains('Save').click();
        cy.url().should('contain', 'item-group/create');
        cy.contains('Is testable is required').should('be.visible');
    })

    it('check cancel button functionality', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.contains('Create').click();
        cy.get('input[name="en_name"]').type('​orange orange');
        cy.get('input[name="ar_name"]').type('رتقال رتقال');
        cy.get('.select2-selection.select2-selection--single.form-control').click({ force: true });
        cy.contains('Cancel').click({force:true});
        cy.url().should('contain', '/items/item-group');
        cy.contains('Create').should('be.visible');
    })

    it('verify input fields is accepting the right input data types', function () {
        cy.contains('Master Data').click({force:true});
        cy.get('a[href="http://127.0.0.1:8000/master-data/items/item-group"]').click({force:true});
        cy.contains('Create').click();
        cy.get('input[name="en_name"]').type('​برتقال 8**');
        cy.get('input[name="ar_name"]').type('orange @66');
        cy.contains('Save').click();
        cy.url().should('contain', 'item-group/create');
        cy.contains('invalid data type').should('be.visible');
    })

    afterEach(function () {
        cy.exec('php artisan user:remove_permission item-group.create');
        cy.exec('php artisan user:remove_permission item-group.index');
    })


})

