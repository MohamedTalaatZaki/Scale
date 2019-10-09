describe('edit truck arrival', function () {
    beforeEach(function () {
        cy.exec('php artisan user:setLocale en');
        cy.exec("php artisan user:add_permission trucks-arrival.index");
        cy.exec("php artisan user:add_permission trucks-arrival.edit");
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.get('a[href="#security"]').click();
        cy.get('.sidebar-sub.sidebar-sub-trucks-arrival').click({force: true});
        cy.url().should('contain', '/security/trucks-arrival');
        cy.exec('php artisan item_group:demo_faker');
        cy.exec('php artisan item:demo_faker');
        cy.exec('php artisan supplier:demo_faker');
        cy.exec('php artisan center:demo_faker');
        cy.exec('php artisan user:setLocale en');
        cy.exec('php artisan test:create_truck_arrival');
        cy.reload();
        cy.get('a[href="http://127.0.0.1:8000/security/trucks-arrival/9999/edit"]').click();


})


    it('check required fields', function () {

        cy.get('#driver_name').clear().type('  ');
        cy.get('#driver_national_id').clear().type('  ');
        cy.get('#driver_mobile').clear().type('  ');
        cy.get('#driver_license').clear().type('  ');
        cy.get('#truck_plates_tractor').clear().type('  ');
        cy.get('#theoreticalWeight').clear().type('  ');
        cy.get('.btn-group-sm > .btn-primary').click();
        cy.url().should('contain', '/security/trucks-arrival');
        cy.contains('The Driver Name field is required.').should('be.visible');
        cy.contains('The Driver License field is required.').should('be.visible');
        cy.contains('The Driver National ID field is required.').should('be.visible');
        cy.contains('The Driver Mobile field is required.').should('be.visible');
        cy.contains('The Truck Plates Tractor field is required.').should('be.visible');
        cy.contains('Theoretical Weight Required').should('be.visible');
    });

    it('check datatype/length fields', function () {
        cy.get('#driver_name').clear().type('666');
        cy.get('#driver_national_id').clear().type('new');
        cy.get('#driver_mobile').clear().type('111');
        cy.get('#theoreticalWeight').clear().type('new name');
        cy.get('.btn-group-sm > .btn-primary').click();
        cy.wait(2000);
        cy.url().should('contain','/security/trucks-arrival');
        cy.contains('The Driver National ID must be 14 digits.').should('be.visible');
        cy.contains('The Driver National ID must be 14 digits.').should('be.visible');
        cy.contains('The Driver Mobile must be 11 digits.').should('be.visible');
        cy.contains('Theoretical Weight Required').should('be.visible');
    })

    // it.only('checks permission of edit by url',function() {
    //     cy.exec("php artisan user:remove_permission trucks-arrival.edit");
    //     cy.visit('http://127.0.0.1:8000/security/trucks-arrival');
    //     cy.get('a[href="http://127.0.0.1:8000/security/trucks-arrival/9999/edit"]').should('not.be.visible');
    //     cy.visit('http://127.0.0.1:8000/security/trucks-arrival/9999/edit', {failOnStatusCode: false});
    //     cy.get('.code').should('contain', '403')
    //     cy.exec("php artisan user:remove_permission trucks-arrival.index");
    //     cy.visit('http://127.0.0.1:8000/security/trucks-arrival', {failOnStatusCode: false});
    //     cy.get('.code').should('contain', '403')
    // })


    afterEach(function () {
         cy.exec("php artisan migrate:refresh && php artisan db:seed");
    });
})
