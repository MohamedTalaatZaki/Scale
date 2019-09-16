describe('Edit Supplier test', function () {
    before(function(){
      cy.exec('php artisan item_group:demo_faker');
      cy.exec('php artisan item:edit_faker');
      cy.exec('php artisan item:demo_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission items.index');
        cy.exec('php artisan user:add_permission items.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/items/items');
        cy.get(':nth-child(1) > :nth-child(8) > .btn').click();
        cy.url().should('contain','/master-data/items/items/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body input[name="sap_code"]').clear();
    cy.get('#item_group_id :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('#item_type_id :nth-child(1)').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.url().should('contain','/master-data/items/items/1000/edit');
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('Item group is required').should('be.visible');
    cy.contains('SAP code is required').should('be.visible');
    cy.contains('Item Type is required').should('be.visible');
  })
  it('checks unique fields', function () {
    cy.get('.card-body input[name="sap_code"]').clear().type('666');
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('.card-body input[name="ar_name"]').clear().type('الاسكندريه');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#item_type_id option[value="2"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/items/items/1000/edit');
    cy.get('.error').should('contain','SAP code is duplicated')
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('input[name="is_active"]').invoke('attr', 'checked',false);
    cy.get('input[name="is_active"]').invoke('attr', 'value',0);
    cy.get('.card-body input[name="ar_name"]').clear().type('الاسكريه');
    cy.get('.card-body input[name="sap_code"]').clear().type('789456');
    cy.get('#item_group_id option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#item_type_id option[value="2"]').invoke('attr', 'selected',true);
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Item Updated Success')
    cy.server();
    cy.request('get','/api/item/789456').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Alex')
      expect(response.body).to.have.property('sap_code', '789456')
      expect(response.body).to.have.property('ar_name','الاسكريه')
      expect(response.body).to.have.property('is_active', 0)
      expect(response.body).to.have.property('item_type_id', 2)
      expect(response.body).to.have.property('item_group_id', 10001)
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission items.edit");
    cy.visit('/master-data/items/items');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/items/items/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission items.index");

    cy.visit('/master-data/items/items',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
