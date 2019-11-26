describe("test edit queue monitor",function () {
    beforeEach(function () {
        cy.exec("php artisan user:add_permission edit-queue.index");
        cy.exec('php artisan user:setLocale en');
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test')
        cy.get(':nth-child(3) > .form-control').type('123456')
        cy.contains('Sign In').click();
        cy.visit('http://127.0.0.1:8000/security/trucks/queue-edit');
        cy.wait(2000);

    })
    before(function () {

        cy.exec("php artisan migrate:refresh && php artisan db:seed");
        cy.exec('php artisan item_group:demo_faker');
        cy.exec('php artisan item:demo_faker');
        cy.exec('php artisan supplier:demo_faker');
        cy.exec('php artisan qc_test:fake_qc_details');
        cy.exec('php artisan test:create_truck_arrival_edit');
        cy.exec('php artisan test:create_truck_arrival_edit1');
        cy.exec('php artisan test:create_truck_arrival_edit2');
        cy.exec('php artisan sample_test:create_sample_test');
    });

    it('check page content', function () {
        cy.get('h3').should('contain', 'Raw');
        cy.get('h3').should('contain', 'Scrap');
        cy.get('h3').should('contain', 'Finish');
    })


    it('check order numbering after editing', function () {
        // drag and drop function
        cy.get('the dragged element').should('have.attr', 'data-order', '1');
    })

    it('check order update in queue index after editing', function () {
        // drag and drop function
        cy.get('the dragged element got by id').should('have.attr', 'data-order', '1');
        cy.visit('http://127.0.0.1:8000/security/queue');
        cy.get('the dragged element got by id').should('have.attr','data-order','1')
    })



})


