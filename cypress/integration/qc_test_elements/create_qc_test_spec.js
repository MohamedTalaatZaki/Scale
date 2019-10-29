beforeEach(function () {
    cy.exec("php artisan user:add_permission qc-elements.index");
    cy.exec("php artisan user:add_permission qc-elements.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.url().should('contain','/master-data/qc-elements');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/qc-elements/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('Create QC Test Element', function () {
  it('checks required fields', function () {
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-elements/create');
    cy.get('.error').should('contain','The English Name field is required.')
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The test type field is required.').should('be.visible');
    cy.contains('The element type field is required.').should('be.visible');
  })
  it('checks cancel fields', function () {
    cy.get('input[name="en_name"]').type('new');
    cy.get('input[name="en_name"]').type('نيو');
    cy.get('select[name="test_type"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="element_type"] option[value="range"]').invoke('attr', 'selected',true);
    cy.get('input[name="element_unit"]').type('mg');
    cy.get('a > .btn-danger').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-elements');
  })
  it('checks element unit fields', function () {
    cy.get('input[name="en_name"]').type('newel');
    cy.get('input[name="ar_name"]').type('نيو عنصر');
    cy.get('select[name="test_type"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="element_type"] option[value="question"]').invoke('attr', 'selected',true);
    cy.get('input[name="element_unit"]').clear();
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-elements');
    cy.get('.text-center').should('contain','Created Successful')
    cy.server();
    cy.request('get','/api/qc_element/newel').then((response)=>{
      console.log(response);
       expect(response.body).to.have.property('en_name', 'newel')
       expect(response.body).to.have.property('ar_name', 'نيو عنصر')
       expect(response.body).to.have.property('test_type', 'visual')
       expect(response.body).to.have.property('element_type', 'question')
     })
  })
  it('checks all fields', function () {
    cy.get('input[name="en_name"]').type('new');
    cy.get('input[name="ar_name"]').type('نيو');
    cy.get('select[name="test_type"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="element_type"] option[value="range"]').invoke('attr', 'selected',true);
    cy.get('input[name="element_unit"]').type('mg');
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-elements');
    cy.get('.text-center').should('contain','Created Successful')
    cy.server();
    cy.request('get','/api/qc_element/new').then((response)=>{
      console.log(response);
       expect(response.body).to.have.property('en_name', 'new')
       expect(response.body).to.have.property('ar_name', 'نيو')
       expect(response.body).to.have.property('test_type', 'visual')
       expect(response.body).to.have.property('element_type', 'range')
       expect(response.body).to.have.property('element_unit', 'mg')
     })
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission qc-elements.create");
    cy.visit('/master-data/qc-elements');
    cy.get('.button-container > a > button').should('not.be.visible');
    cy.visit('/master-data/qc-elements/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission qc-elements.index");
    cy.visit('/master-data/qc-elements',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/');
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
