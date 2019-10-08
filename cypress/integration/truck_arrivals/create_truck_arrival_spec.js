beforeEach(function () {
  //  cy.exec("php artisan user:add_permission trucks-arrival.index");
  //  cy.exec("php artisan user:add_permission trucks-arrival.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    // cy.get('a[href="#security"]').should('be.visible');
    // cy.get('a[href="#security"]').click();
  //  cy.get('.sidebar-sub > .d-inline-block').click({ force: true });
    cy.visit('/security/trucks-arrival');
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
});
  describe('Create truck arrival', function () {
  it('checks required fields', function () {
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.url().should('contain','/security/trucks-arrival');
    cy.get('.error').should('contain','The Driver Name field is required.')
    cy.contains('The Driver License field is required.').should('be.visible');
    cy.contains('The Driver National ID field is required.').should('be.visible');
    cy.contains('The Driver Mobile field is required.').should('be.visible');
    cy.contains('The Supplier field is required.').should('be.visible');
    cy.contains('The Governorate field is required.').should('be.visible');
    cy.contains('The City field is required.').should('be.visible');
    cy.contains('The Truck Type field is required.').should('be.visible');
    cy.contains('The Truck Plates Tractor field is required.').should('be.visible');
    cy.contains('The Item Type field is required.').should('be.visible');
    cy.get('#itemTypeSelect option[value="1"]').invoke('attr', 'selected',true);
    cy.get('#itemTypeSelect').trigger('change',{force:true});
    cy.wait(2000);
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.url().should('contain','/security/trucks-arrival');
    cy.contains('Item Group Required').should('be.visible');
    cy.contains('Theoretical Weight Required').should('be.visible');
  })

  it('checks datatype/length fields', function () {
     cy.get('#driver_name').type('666');
     cy.get('#driver_national_id').type('new');
     cy.get('#driver_mobile').type('pppppppp');
     cy.get('#itemTypeSelect option[value="1"]').invoke('attr', 'selected',true);
     cy.get('#itemTypeSelect').trigger('change',{force:true});
     cy.wait(2000);
     cy.get('#theoreticalWeight').type('new name');
     cy.get('.btn-group-sm > .btn-primary').click();
     cy.url().should('contain','/security/trucks-arrival');
     cy.get('.error').should('contain','The Driver Name field is required.')
     cy.contains('The Driver National ID must be 14 digits.').should('be.visible');
     cy.contains('The Driver Mobile must be 11 digits.').should('be.visible');
     cy.contains('The Driver License field is required.').should('be.visible');
     cy.contains('Theoretical Weight Required').should('be.visible');
  })
  it('checks nullable/nested fields',function(){
    var x = Cypress.$("#governorate_select");
    x.val(1);
    x.trigger("click");
    cy.get('#governorate_select').select("1",{"force":true});

    cy.get('#driver_name').type('new_name');
    cy.get('#driver_national_id').type('12345678974185');
    cy.get('#driver_license').type('132456789');
    cy.get('#truck_plates_tractor').type('uuq2');
    cy.get('#truck_type option[value="1"]').invoke('attr', 'selected',true);
    cy.wait(2000);
    cy.get('#citySelect option[value="1"]').invoke('attr', 'selected',true);
    cy.get('#itemTypeSelect option[value="1"]').invoke('attr', 'selected',true);
    cy.get('#itemTypeSelect').trigger('change',{force:true});
    cy.get('#driver_mobile').type('12345678912');

    var x = Cypress.$("#supplierSelect");
    x.val(1000);
    x.trigger("click");
    cy.get('#supplierSelect').select("1000",{"force":true});
    cy.get('#itemsGroupSelect option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#theoreticalWeight').type('123');
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.url().should('contain','/security/trucks-arrival');
    cy.server();
    cy.request('get','/api/truck_arrival/new_name').then((response)=>{
      console.log(response);
       expect(response.body).to.have.property('driver_name', 'new_name')
       expect(response.body).to.have.property('status', 'arrived')
       expect(response.body).to.have.property('driver_license', '132456789')
       expect(response.body).to.have.property('driver_national_id', '12345678974185')
       expect(response.body).to.have.property('driver_mobile', '12345678912')

       expect(response.body).to.have.property('supplier_id', 1000)
       expect(response.body).to.have.property('governorate_id', 1)
       expect(response.body).to.have.property('city_id', 1)
       expect(response.body).to.have.property('center_id',null)
       expect(response.body).to.have.property('truck_plates_trailer',null)
       expect(response.body).to.have.property('truck_type_id', 1)
       expect(response.body).to.have.property('truck_plates_tractor', 'uuq2')
       expect(response.body).to.have.property('item_type_id', '1')
       expect(response.body).to.have.property('item_group_id', 10001)
       expect(response.body).to.have.property('theoretical_weight',123)
    });

  })
  it('checks all fields',function(){
    var x = Cypress.$("#governorate_select");
    x.val(1);
    x.trigger("click");
    cy.get('#governorate_select').select("1",{"force":true});

    cy.get('#driver_name').type('old_name');
    cy.get('#driver_national_id').type('12345678974185');
    cy.get('#driver_license').type('132456789');
    cy.get('#truck_plates_tractor').type('uuq2');
    cy.get('#truck_plates_trailer').type('lo23');
    cy.get('#truck_type option[value="1"]').invoke('attr', 'selected',true);
    cy.wait(2000);
    var x = Cypress.$("#citySelect");
    x.val(1);
    x.trigger("click");
    cy.get('#citySelect').select("1",{"force":true});
    cy.get('#itemTypeSelect option[value="1"]').invoke('attr', 'selected',true);
    cy.get('#centerSelect option[value="1000"]').invoke('attr', 'selected',true);
    cy.get('#itemTypeSelect').trigger('change',{force:true});
    cy.get('#driver_mobile').type('12345678912');

    var x = Cypress.$("#supplierSelect");
    x.val(1000);
    x.trigger("click");
    cy.get('#supplierSelect').select("1000",{"force":true});
    cy.get('#itemsGroupSelect option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#theoreticalWeight').type('123');
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.url().should('contain','/security/trucks-arrival');
    cy.server();
    cy.request('get','/api/truck_arrival/old_name').then((response)=>{
      console.log(response);
       expect(response.body).to.have.property('driver_name', 'old_name')
       expect(response.body).to.have.property('status', 'arrived')
       expect(response.body).to.have.property('driver_license', '132456789')
       expect(response.body).to.have.property('driver_national_id', '12345678974185')
       expect(response.body).to.have.property('driver_mobile', '12345678912')

       expect(response.body).to.have.property('supplier_id', 1000)
       expect(response.body).to.have.property('governorate_id', 1)
       expect(response.body).to.have.property('city_id', 1)
       expect(response.body).to.have.property('center_id',1000)
       expect(response.body).to.have.property('truck_plates_trailer','lo23')
       expect(response.body).to.have.property('truck_type_id', 1)
       expect(response.body).to.have.property('truck_plates_tractor', 'uuq2')
       expect(response.body).to.have.property('item_type_id', '1')
       expect(response.body).to.have.property('item_group_id', 10001)
       expect(response.body).to.have.property('theoretical_weight',123)
    });
  })
  it('checks create permissions',function(){
    // cy.exec("php artisan user:remove_permission trucks-arrival.create");
    // cy.visit('/security/trucks-arrival');
    // cy.get('.button-container > a > button').should('not.be.visible');
    // cy.visit('/security/trucks-arrival',{ failOnStatusCode: false});
    // cy.get('.code').should('contain','403')
    // cy.exec("php artisan user:remove_permission qtrucks-arrival.index");
    // cy.visit('/security/trucks-arrival',{ failOnStatusCode: false});
    // cy.get('.code').should('contain','403')
    // cy.visit('/');
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
