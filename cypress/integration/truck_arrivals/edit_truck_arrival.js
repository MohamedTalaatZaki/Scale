beforeEach(function () {
    cy.exec("php artisan user:add_permission trucks-arrival.index");
    cy.exec("php artisan user:add_permission trucks-arrival.edit");
    cy.visit('http://127.0.0.1:8000/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('.sidebar sidebar-security > .d-inline-block').click({ force: true });
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/security/trucks-arrival');
    cy.get('div.container-fluid > form').invoke('attr', 'noValidate','true');
})
before(function(){
    cy.exec('php artisan item_group:demo_faker');
    cy.exec('php artisan item:demo_faker');
    cy.exec('php artisan supplier:demo_faker');
    cy.exec('php artisan center:demo_faker');
    cy.exec('php artisan user:setLocale en');
    cy.exec('php artisan test:create_truck_arrival');

});
describe('Edit truck arrival', function () {
    it('check required fields', function () {

        cy.get('#driver_name').clear().type('  ');
        cy.get('#driver_national_id').clear().type('  ');
        cy.get('#driver_mobile').clear().type('  ');
        cy.get('#driver_license').clear().type('  ');
        cy.get('#truck_plates_tractor').clear().type('  ');
        cy.get('.btn-group-sm > .btn-primary').click();
        cy.url().should('contain','/security/trucks-arrival');
        cy.contains('The Driver Name field is required.').should('be.visible');
        cy.contains('The Driver License field is required.').should('be.visible');
        cy.contains('The Driver National ID field is required.').should('be.visible');
        cy.contains('The Driver Mobile field is required.').should('be.visible');
        cy.contains('The Truck Plates Tractor field is required.').should('be.visible');

    });

    after(function(){
        cy.exec("php artisan migrate:refresh && php artisan db:seed");
    });
})
