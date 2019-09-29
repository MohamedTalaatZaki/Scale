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
    cy.get('.error').should('contain','The English Name field is required.')
    cy.contains('The Arabic Name field is required.').should('be.visible');
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

    cy.get('select[name="details[0][element_type]"]').trigger('change');
    cy.wait(2000);
    cy.get('input[name="details[0][min_range]"]').should('be.visible');
    cy.get('input[name="details[0][element_unit]"]').should('be.visible');
    cy.get('#expected_result').should('not.be.visible');
    cy.get('.card-body input[name="details[0][min_range]"]').type('Alex');
    cy.get('.card-body input[name="details[0][max_range]"]').type('Alex');
    cy.get('.card-body input[name="details[0][element_unit]"]').type('Alex');
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The English Name field is required.')
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Max Range field is required when Element Type is range.').should('be.visible');

    cy.get('.card-body input[name="details[0][min_range]"]').type('10');
    cy.get('.card-body input[name="details[0][max_range]"]').type('5');
    cy.get('.card-body input[name="details[0][element_unit]"]').type('Alex');
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The English Name field is required.')
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Max Range field is required when Element Type is range.').should('be.visible');

  })
  it('checks questions fields', function () {
    cy.get('.card-body input[name="en_name"]').type('اسم');
    cy.get('.card-body input[name="ar_name"]').type('eng');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="details[0][en_name]"]').type('اسم');
    cy.get('.card-body input[name="details[0][ar_name]"]').type('eng');
    cy.get('select[name="details[0][test_type]"] option[value="visual"]').invoke('attr', 'selected',true);
    cy.get('select[name="details[0][element_type]"] option[value="question"]').invoke('attr', 'selected',true);
    cy.get('select[name="details[0][element_type]"]').trigger('change')
    cy.wait(2000)
    cy.get('input[name="details[0][min_range]"]').should('not.be.visible');
    cy.get('input[name="details[0][max_range]"]').should('not.be.visible');
    cy.get('input[name="details[0][element_unit]"]').should('not.be.visible');
    cy.get('#expected_result').should('be.visible');

    cy.get('#expected_result option[value=""]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/qc-test-headers/create');
    cy.get('.error').should('contain','The English Name field is required.')
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The English Name field is required.').should('be.visible');
    cy.contains('The Arabic Name field is required.').should('be.visible');
    cy.contains('The Expected Result field is required when Element Type is question.').should('be.visible');
  })
  it('checks enabled default values / add-remove item button',function(){

      cy.get('.card-body input[name="ar_name"]').type('اسم');
      cy.get('.card-body input[name="en_name"]').type('eng');
      cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
      cy.get('.card-body input[name="details[0][ar_name]"]').type('اسم');
      cy.get('.card-body input[name="details[0][en_name]"]').type('eng');
      cy.get('select[name="details[0][test_type]"] option[value="visual"]').invoke('attr', 'selected',true);
      cy.get('select[name="details[0][element_type]"] option[value="range"]').invoke('attr', 'selected',true);

      cy.get('select[name="details[0][element_type]"]').trigger('change');
      cy.wait(2000);
      cy.get('.card-body input[name="details[0][min_range]"]').type('5');
      cy.get('.card-body input[name="details[0][max_range]"]').type('10');
      cy.get('.card-body input[name="details[0][element_unit]"]').type('mg');
      cy.get(':nth-child(1) > :nth-child(9) > .btn-group > .btn').click();

      cy.get('.card-body input[name="details[1][ar_name]"]').type('تاني اسم');
      cy.get('.card-body input[name="details[1][en_name]"]').type('second name');
      cy.get('select[name="details[1][test_type]"] option[value="visual"]').invoke('attr', 'selected',true);

      cy.get('select[name="details[1][element_type]"] option[value="question"]').invoke('attr', 'selected',true);
      cy.get('select[name="details[1][element_type]"]').trigger('change');
      cy.wait(2000);
      cy.get('select[name="details[1][expected_result]"] option[value="1"]').invoke('attr', 'selected',true);
      cy.get('[data-repeater-item=""][style=""] > :nth-child(9) > .btn-group > .btn-info > .simple-icon-plus').click();

      cy.get('.card-body input[name="details[2][ar_name]"]').type('تاني اسم');
      cy.get('.card-body input[name="details[2][en_name]"]').type('second name');
      cy.get('select[name="details[2][test_type]"] option[value="chemical"]').invoke('attr', 'selected',true);

      cy.get('select[name="details[2][element_type]"] option[value="question"]').invoke('attr', 'selected',true);
      cy.get('select[name="details[2][element_type]"]').trigger('change');
      cy.wait(2000);
      cy.get('select[name="details[2][expected_result]"] option[value="1"]').invoke('attr', 'selected',true);
      cy.get(':nth-child(2) > :nth-child(9) > .btn-group > .btn-dark').click();
      cy.get('.float-right > .btn-primary').click();
      cy.wait(2000);
      cy.url().should('contain','/master-data/qc-test-headers');

      cy.get('.text-center').should('contain','Created Successful')
      cy.server();
      cy.request('get','/api/qc_test/eng').then((response)=>{
        console.log(response);
         expect(response.body).to.have.property('en_name', 'eng')
         expect(response.body).to.have.property('is_active', 1)
         expect(response.body).to.have.property('item_group_id', 10001)
         expect(response.body).to.have.property('item_group_id', 10001)
         expect(response.body).to.have.property('ar_name', 'اسم')

         expect(response.body.details[0]).to.have.property('en_name', 'eng')
         expect(response.body.details[0]).to.have.property('ar_name', 'اسم')
         expect(response.body.details[0]).to.have.property('test_type', 'visual')
         expect(response.body.details[0]).to.have.property('element_type', 'range')
         expect(response.body.details[0]).to.have.property('min_range', 5)
         expect(response.body.details[0]).to.have.property('max_range', 10)

         expect(response.body.details[1]).to.have.property('en_name', 'second name')
         expect(response.body.details[1]).to.have.property('ar_name','تاني اسم')
         expect(response.body.details[1]).to.have.property('test_type', 'chemical')
         expect(response.body.details[1]).to.have.property('element_type', 'question')
         expect(response.body.details[1]).to.have.property('expected_result', 1)
      });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission qc-test-headers.create");
    cy.visit('/master-data/qc-test-headers');
    cy.get('.button-container > a > button').should('not.be.visible');
    cy.visit('/master-data/qc-test-headers/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission qc-test-headers.index");
    cy.visit('/master-data/qc-test-headers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/');
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
