describe('create scales test', function () {
    beforeEach(function () {
        cy.exec('php artisan user:setLocale en');
        cy.exec('php artisan user:add_permission scales.index');
        cy.exec('php artisan user:add_permission scales.create');
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.get('a[href="#masterData"]').should('be.visible');
        cy.get('a[href="#masterData"]').click();
        cy.get('.sidebar-sub-scales').click({force: true});
        cy.url().should('contain', '/master-data/scales');
        cy.get('.btn.btn-primary.btn-sm.top-right-button.mr-1').click();
        cy.url().should('contain', '/master-data/scales/create');

    })
    it('check mandatory fields', function () {
        cy.get('input[name="code"]').type(' ');
        cy.get('input[name="ip_address"]').type(' ');
        cy.get('input[name="brand"]').type(' ');
        cy.get('input[name="com_port"]').type(' ');
        cy.get('select[name="baud_rate"]').select('75', {force: true});
        cy.get('select[name="byte_size"]').select('FIVEBITS', {force: true});
        cy.get('select[name="parity"]').select('PARITY_EVEN', {force: true});
        cy.get('select[name="stop_bits"]').select('STOPBITS_ONE', {force: true});
        cy.contains('Save').click();
        cy.contains('The code field is required.').should('be.visible');
        cy.contains('The ip address field is required.').should('be.visible');
        cy.contains('The brand field is required.').should('be.visible');
        cy.contains('The com port field is required.').should('be.visible');
        cy.url().should('contain', '/scales/create');
        cy.get('input[name="code"]').clear().type('123');
        cy.get('input[name="ip_address"]').clear().type('888');
        cy.get('input[name="brand"]').clear().type('new');
        cy.get('input[name="com_port"]').clear().type('456');
        cy.get('select[name="baud_rate"]').invoke('attr', 'value', '75');
        cy.get('select[name="byte_size"]').invoke('attr', 'value', 'FIVEBITS');
        cy.get('select[name="parity"]').invoke('attr', 'value', 'PARITY_EVEN');
        cy.get('select[name="stop_bits"]').invoke('attr', 'value', 'STOPBITS_ONE');
        cy.contains('Save').click();
        cy.contains('Scale Created Successful').should('be.visible');
    })

    it('check Unique fields', function () {
        cy.get('input[name="code"]').type('123');
        cy.get('input[name="ip_address"]').type('888');
        cy.get('input[name="brand"]').clear().type('new');
        cy.get('input[name="com_port"]').clear().type('456');
        cy.get('select[name="baud_rate"]').select('75', {force: true});
        cy.get('select[name="byte_size"]').select('FIVEBITS', {force: true});
        cy.get('select[name="parity"]').select('PARITY_EVEN', {force: true});
        cy.get('select[name="stop_bits"]').select('STOPBITS_ONE', {force: true});
        cy.contains('Save').click();
        cy.url().should('contain', '/scales/create');
        cy.contains('The code has already been taken.').should('be.visible');
        cy.contains('This Ip Address Already Exist').should('be.visible');
    })

    it('check that non permitted pages is not accessible via URL ', function () {
        cy.exec('php artisan user:remove_permission scales.create');
        cy.exec('php artisan user:remove_permission scales.index');
        cy.visit('http://127.0.0.1:8000/');
        cy.contains('Master Data').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/scales/create', {failOnStatusCode: false});
        cy.get('.code').should('contain', '403');
        cy.exec('php artisan user:add_permission scales.index');
        cy.exec('php artisan user:add_permission scales.create');
        cy.visit('http://127.0.0.1:8000/master-data/scales/');
        cy.contains('Create').should('be.visible');
    })

    it('check scale limit , error fields data type ', function () {
        cy.get('input[name="limit"]').should('have.attr', 'type', 'number');
        cy.get('input[name="scale_error"]').should('have.attr', 'type', 'number');
        cy.get('input[name="timeout"]').should('have.attr', 'type', 'number');
    })

    it('check default values functionality\n', function () {
        cy.get('input[name="code"]').clear().type('1234');
        cy.get('input[name="ip_address"]').clear().type('8888');
        cy.get('input[name="brand"]').clear().type('new');
        cy.get('input[name="com_port"]').clear().type('456');
        cy.get('select[name="baud_rate"]').select('75', {force: true});
        cy.get('select[name="byte_size"]').select('FIVEBITS', {force: true});
        cy.get('select[name="parity"]').select('PARITY_EVEN', {force: true});
        cy.get('select[name="stop_bits"]').select('STOPBITS_ONE', {force: true});
        cy.contains('Save').click();
        cy.contains('Scale Created Successful').should('be.visible');
        cy.request('http://127.0.0.1:8000/api/scales/1234').then((response) => {
            expect(response.body).to.have.property('limit', 100000);
            expect(response.body).to.have.property('scale_error', 0);
            expect(response.body).to.have.property('tolerance', 0);
            expect(response.body).to.have.property('is_active', 1);
        })

    })

    it('check disabled functionality', function () {
        cy.exec('php artisan test:create_scale_test');
        cy.get('input[name="code"]').type('12345');
        cy.get('input[name="ip_address"]').type('9999');
        cy.get('input[name="brand"]').type('new');
        cy.get('input[name="com_port"]').type('456');
        cy.get('select[name="baud_rate"]').select('75', {force: true});
        cy.get('select[name="byte_size"]').select('FIVEBITS', {force: true});
        cy.get('select[name="parity"]').select('PARITY_EVEN', {force: true});
        cy.get('select[name="stop_bits"]').select('STOPBITS_ONE', {force: true});
        cy.contains('Save').click();
        cy.contains('Scale Created Successful').should('be.visible');
        cy.exec('php artisan test:delete_scale_test');
    })


    afterEach(function () {
        cy.exec('php artisan user:remove_permission scales.create');
        cy.exec('php artisan user:remove_permission scales.index');
    })
    after(function () {
        cy.exec('php artisan test:delete_scale');
        cy.exec('php artisan test:delete_scale2');
        cy.exec('php artisan test:delete_scale3');
    })


})
