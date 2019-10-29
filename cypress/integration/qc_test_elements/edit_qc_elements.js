describe('edit QC Test Element', function () {

    beforeEach(function () {
        cy.exec("php artisan user:add_permission qc-elements.index");
        cy.exec("php artisan user:add_permission qc-elements.edit");
        cy.exec("php artisan test:create_qc_element");
        cy.visit('http://127.0.0.1:8000');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test')
        cy.get(':nth-child(3) > .form-control').type('123456')
        cy.contains('Sign In').click();
        cy.get('a[href="#masterData"]').should('be.visible');
        cy.get('a[href="#masterData"]').click();
        cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
        cy.url().should('contain','/master-data/qc-elements');
        cy.get('a[href="http://127.0.0.1:8000/master-data/qc-elements/9999/edit"]').click();
        cy.url().should('contain', 'http://127.0.0.1:8000/master-data/qc-elements/9999/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
        cy.exec('php artisan user:setLocale en');
    });
    it('check required fields', function () {
        cy.get('name="en_name"').clear().type('  ');
        cy.get('name="ar_name"').clear().type('  ');
        cy.get('name="element_unit"').clear().type('  ');
        cy.get('.float-right > .btn-primary').click();
        cy.wait(2000);
        cy.url().should('contain','/master-data/qc-elements/9999/edit');
        cy.contains('The Arabic Name field is required.').should('be.visible');
        cy.contains('The English Name field is required.').should('be.visible');
        cy.contains('The element unit field is required when element type is range.').should('be.visible');
    })

    it('checks element field nullable when the type is question', function () {
        cy.get('input[name="en_name"]').type('testing');
        cy.get('input[name="ar_name"]').type('اختبلر');
        cy.get('select[name="test_type"] option[value="visual"]').invoke('attr', 'selected',true);
        cy.get('select[name="element_type"] option[value="question"]').invoke('attr', 'selected',true);
        cy.get('input[name="element_unit"]').clear();
        cy.get('.float-right > .btn-primary').click();
        cy.wait(2000);
        cy.url().should('contain','/master-data/qc-elements');
        cy.get('.text-center').should('contain','Created Successful');
        })
    it('checks edit permissions',function(){
        cy.exec("php artisan user:remove_permission qc-elements.edit");
        cy.visit('/master-data/qc-elements');
        cy.get('a[href="http://127.0.0.1:8000/master-data/qc-elements/9999/edit"]').should('not.be.visible');
        cy.visit('a[href="http://127.0.0.1:8000/master-data/qc-elements/9999/edit"]',{ failOnStatusCode: false});
        cy.get('.code').should('contain','403')
        cy.exec("php artisan user:remove_permission qc-elements.index");
        cy.visit('/master-data/qc-elements',{ failOnStatusCode: false});
        cy.get('.code').should('contain','403')
    });

    after(function(){
        cy.exec("php artisan migrate:refresh && php artisan db:seed");
        cy.exec("php artisan test:delete_qc_element");
    });
});

