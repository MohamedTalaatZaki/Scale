describe('scrap process test', function () {
    before(function(){
        cy.exec("php artisan migrate:fresh && php artisan db:seed");
        cy.exec("php artisan user:add_permission scrap-process.index");
        cy.exec("php artisan user:add_permission scrapStartProcess");
        cy.exec("php artisan user:add_permission scrapFinishProcess");
        cy.exec('php artisan user:setLocale en');
        cy.exec('php artisan sample_test:create_item_group_scrap');
        cy.exec('php artisan supplier:demo_faker');
        cy.exec('php artisan sample_test:create__item_scrap');
        cy.exec('php artisan sample_test:create__item_supplier');
        cy.exec("php artisan sample_test:create_truck_arrival_scrap");
    });
    beforeEach(function () {
        cy.visit('http://127.0.0.1:8000/');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test')
        cy.get(':nth-child(3) > .form-control').type('123456')
        cy.contains('Sign In').click();
        cy.get('a[href="#production"]').should('be.visible');
        cy.get('a[href="#production"]').click();
        cy.get('a[href="http://127.0.0.1:8000/production/scrap-process"]').click({ force: true });
        cy.url().should('contain','http://127.0.0.1:8000/production/scrap-process');

    });
    it('check mandatory fields', function () {
        cy.get('button[data-detail-id="1000"]').click();
        cy.get('form[action="http://127.0.0.1:8000/production/scrap-process-start"]').should('be.visible');
        cy.get('select[id="lineSelect"]').should('have.attr','required');
        cy.get('select[id="itemsGroupSelect"]').should('have.attr','required');
        cy.get('select[id="itemsSelect"]').should('have.attr','required');

    });

    it.only('check nested -Choose line according to type', function () {
        cy.get('button[data-detail-id="1000"]').click();
        cy.get('form[action="http://127.0.0.1:8000/production/scrap-process-start"]').should('be.visible');
        cy.get('select[id="lineSelect"]')
            .select('Scrap Line 1',{force:true}).should('have.value', '3');
        cy.get('select[id="lineSelect"]')
            .select('Scrap Line 2',{force:true}).should('have.value', '4');

    });


    after(function(){

        // cy.exec("php artisan migrate:refresh && php artisan db:seed");
    });
});
