beforeEach(function () {
    cy.exec("php artisan user:add_permission qc-test-headers.index");
    cy.exec("php artisan user:add_permission qc-test-headers.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/qc-test-headers');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/qc-test-headers/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan item_group:demo_faker');
  cy.exec('php artisan user:setLocale en');
});
describe('Create QC Item', function () {
  it('checks required fields', function () {
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The en name field is required.')
    cy.contains('The ar name field is required.').should('be.visible');
    cy.contains('The item group id field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Element Type field is required.').should('be.visible');
    cy.contains('The Test Type field is required.').should('be.visible');
  })
  it('checks datatype fields', function () {
    cy.get('.card-body input[name="en_name"]').type('اسم');
    cy.get('.card-body input[name="ar_name"]').type('eng');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="details[0][en_name]"]').type('اسم');
    cy.get('.card-body input[name="details[0][ar_name]"]').type('eng');
    cy.get('select[name="details[0][test_type]"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="details[0][element_type]"] option[value="range"]').invoke('attr', 'selected',true);
    cy.get('input[name="details[0][min_range]"]').should('be.visible');
    cy.get('input[name="details[0][element_unit]"]').should('be.visible');
    cy.get('#expected_result').should('not.exist');
    cy.get('.card-body input[name="details[0][min_range]"]').type('Alex');
    cy.get('.card-body input[name="details[0][min_range]"]').type('Alex');
    cy.get('.card-body input[name="details[0][element_unit]"]').type('Alex');
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','SAP code is duplicated')
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The en name field is required.')
    cy.contains('The ar name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Element Unit field is required when Element Type is range.').should('be.visible');
  })
  it('checks questions fields', function () {
    cy.get('.card-body input[name="en_name"]').type('اسم');
    cy.get('.card-body input[name="ar_name"]').type('eng');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="details[0][en_name]"]').type('اسم');
    cy.get('.card-body input[name="details[0][ar_name]"]').type('eng');
    cy.get('select[name="details[0][test_type]"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="details[0][element_type]"] option[value="question"]').invoke('attr', 'selected',true);
    cy.get('input[name="details[0][min_range]"]').should('not.exist');
    cy.get('input[name="details[0][element_unit]"]').should('not.exist');
    cy.get('#expected_result').should('be.visible');

    cy.get('#expected_result option[value="1"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','SAP code is duplicated')
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The en name field is required.')
    cy.contains('The ar name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Expected Result field is required when Element Type is question.').should('be.visible');
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission qc-test-headers.create");
    cy.visit('/master-data/qc-test-headers');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/qc-test-headers/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission qc-test-headers.index");
    cy.visit('/master-data/qc-test-headers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
