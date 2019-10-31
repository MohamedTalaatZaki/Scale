describe('create sample test', function () {
    beforeEach(function () {
        cy.exec('php artisan user:setLocale en');
        cy.exec('php artisan user:add_permission arrived-trucks.index');
        cy.exec('php artisan test:create_truck_arrival2')
        cy.exec('php artisan test:create_truck_arrival11')
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.get('a[href="#qualityControl"]').should('be.visible');
        cy.get('a[href="#qualityControl"]').click();
        cy.contains('Arrived Trucks').click({force: true});
        cy.url().should('contain', 'http://127.0.0.1:8000/qc/arrived-trucks');
        cy.get('a[href="http://127.0.0.1:8000/qc/samples-test/create?transport_detail_id=99999"]').click();
        cy.url().should('contain', 'http://127.0.0.1:8000/qc/samples-test/create?transport_detail_id=99999');

    })
    it('check mandatory fields', function () {
        cy.get('.btn btn-success mr-5 resultSwal').click();
        cy.contains('Required').should('be visible');

    })

    it('check accepted status', function () {
        cy.get('select[name="details[0][sampled_expected_result]"]').select('Yes', {force: true});
        cy.get('h3[class="final-accepted text-center text-success"]').should('be visible');
        cy.get('.btn btn-success mr-5 resultSwal').click();
        cy.get('#swal2-title').should('be visible');
        cy.get('button[class="swal2-confirm swal2-styled"]').click();
        cy.url().should('contain','http://127.0.0.1:8000/qc/arrived-trucks')
        cy.get('#99999').parent('.col-4').should('contain','Accepted');


    })

    it('check rejected status', function () {
        cy.get('select[name="details[0][sampled_expected_result]"]').select('No', {force: true});
        cy.get('h3[class="final-accepted text-center text-success"]').should('be visible');
        cy.get('.btn btn-success mr-5 resultSwal').click();
        cy.get('#swal2-title').should('be visible');
        cy.get('button[class="swal2-confirm swal2-styled"]').click();
        cy.url().should('contain','http://127.0.0.1:8000/qc/arrived-trucks')
        cy.get('#99999').parent('.col-4').should('contain','Accepted');


    })


    afterEach(function () {
        cy.exec('php artisan migrate');
        cy.exec('php artisan db:seed');
    })




})
