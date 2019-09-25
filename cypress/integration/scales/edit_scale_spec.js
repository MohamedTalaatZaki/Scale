describe('Edit Scale test', function () {
    before(function(){
      cy.exec('php artisan scale:demo_faker');
      cy.exec('php artisan scale:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission scales.index');
        cy.exec('php artisan user:add_permission scales.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/scales');
        cy.get(':nth-child(2) > :nth-child(7) > .btn').click();
        cy.url().should('contain','/master-data/scales/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="code"]').clear();
    cy.get('.card-body input[name="ip_address"]').clear();
    cy.get('.card-body input[name="brand"]').clear();
    cy.get('.card-body input[name="com_port"]').clear();
    cy.get('.card-body input[name="timeout"]').clear();
    cy.get('select[name="byte_size"] :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('select[name="parity"] :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('select[name="stop_bits"] :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.url().should('contain','/master-data/scales/1000/edit');
    cy.contains('The code field is required.').should('be.visible');
    cy.contains('The ip address field is required.').should('be.visible');
    cy.contains('The brand field is required.').should('be.visible');
    cy.contains('The com port field is required.').should('be.visible');
    cy.contains('The byte size field is required.').should('be.visible');
    cy.contains('The parity field is required.').should('be.visible');
    cy.contains('The stop bits field is required.').should('be.visible');
  })
  it('checks unique fields', function () {
    cy.get('.card-body input[name="code"]').clear().type('666');
    cy.get('.card-body input[name="ip_address"]').clear().type('123');
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/scales/1000/edit');
    cy.contains('The code has already been taken.').should('be.visible');
    cy.contains('This Ip Address Already Exist').should('be.visible');
  })
  it('checks datatype', function () {
    cy.get('.card-body input[name="limit"]').clear().type('wqwq');
    cy.get('.card-body input[name="scale_error"]').clear().type('wqwq');
    cy.get('.card-body input[name="tolerance"]').clear().type('wqwq');
    cy.get('.card-body input[name="timeout"]').clear().type('wqwq');
    cy.get('.float-right > .btn-primary').click();
    cy.url().should('contain','/master-data/scales/1000/edit');
    cy.contains('The limit field validate.').should('be.visible');
    cy.contains('The error field validate.').should('be.visible');
    cy.contains('The timeout field validate.').should('be.visible');
  })
  it('checks ip redundant value if scale disabled',function(){
    cy.get('input[name="is_active"]').invoke('attr', 'checked',false);
    cy.get('input[name="is_active"]').invoke('attr', 'value',0);
    cy.get('.card-body input[name="ip_address"]').clear().type('123');
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Scale Updated Successful')
    cy.server();
    cy.request('get','/api/scale/789789').then((response)=>{
      console.log(response.body);
      expect(response.body).to.have.property('ip_address', '123')
    });
  })
  it('checks default/nullable fields',function(){
    cy.get('.card-body input[name="scale_error"]').clear();
    cy.get('.card-body input[name="tolerance"]').clear();
    cy.get('.card-body input[name="ip_address"]').clear().type('654321');
    cy.get('.card-body input[name="limit"]').clear();
    cy.get('.card-body input[name="timeout"]').clear();
    cy.get('.card-body input[name="model"]').clear();
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Scale Updated Successful')
    cy.server();
    cy.request('get','/api/scale/789789').then((response)=>{
      console.log(response.body);
      expect(response.body).to.have.property('timeout', 2)
      expect(response.body).to.have.property('tolerance', 0)
      expect(response.body).to.have.property('scale_error', 0)
      expect(response.body).not.to.have.property('model')
      expect(response.body).to.have.property('ip_address', '654321')
      expect(response.body).not.to.have.property('baud_rate')
    });
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="scale_error"]').clear().type('123');
    cy.get('.card-body input[name="ip_address"]').clear().type('123456');
    cy.get('.card-body input[name="tolerance"]').clear().type('123');
    cy.get('.card-body input[name="limit"]').clear().type('123');
    cy.get('.card-body input[name="timeout"]').clear().type('123');
    cy.get('.card-body input[name="model"]').clear().type('123');
    cy.get('.card-body input[name="brand"]').clear().type('new brand');
    cy.get('.card-body input[name="code"]').clear().type('123456789');
    cy.get('.card-body input[name="com_port"]').clear().type('123');
    cy.get('select[name="byte_size"] :nth-child(2)').invoke('attr', 'selected',true);
    cy.get('select[name="parity"] :nth-child(2)').invoke('attr', 'selected',true);
    cy.get('select[name="stop_bits"] :nth-child(2)').invoke('attr', 'selected',true);
    cy.get('select[name="baud_rate"] :nth-child(2)').invoke('attr', 'selected',true);
    cy.get('input[name="is_active"]').invoke('attr', 'checked',true);
    cy.get('input[name="is_active"]').invoke('attr', 'value',1);
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Scale Updated Successful')
    cy.server();
    cy.request('get','/api/scale/123456789').then((response)=>{
      console.log(response.body);
      expect(response.body).to.have.property('timeout', 123)
      expect(response.body).to.have.property('limit', 123)
      expect(response.body).to.have.property('tolerance', 123)
      expect(response.body).to.have.property('scale_error', 123)
      expect(response.body).to.have.property('model', '123')
      expect(response.body).to.have.property('brand', 'new brand')
      expect(response.body).to.have.property('parity', 'PARITY_NONE')
      expect(response.body).to.have.property('stop_bits', 'STOPBITS_ONE')
      expect(response.body).to.have.property('ip_address', '123456')
      expect(response.body).to.have.property('baud_rate', '75')
      expect(response.body).to.have.property('is_active', 1)
      expect(response.body).to.have.property('byte_size', 'FIVEBITS')
      expect(response.body).to.have.property('code', '123456789')
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission scales.edit");
    cy.visit('/master-data/scales');
    cy.get('tr > :nth-child(7) > .btn').should('not.exist');
    cy.visit('/master-data/scales/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission scales.index");

    cy.visit('/master-data/scales',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
