describe('Edit Supplier test', function () {
    before(function(){
      cy.exec('php artisan item_group:demo_faker');
      cy.exec('php artisan item:edit_faker');
      cy.exec('php artisan item:demo_faker');
      cy.exec('php artisan supplier:edit_faker');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission suppliers.index');
        cy.exec('php artisan user:add_permission suppliers.edit');
        cy.exec('php artisan user:setLocale en');
        cy.visit('/');
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.visit('/master-data/suppliers');
        cy.get(':nth-child(7) > .btn').click();
        cy.url().should('contain','/master-data/suppliers/1000/edit');
        cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
  })
  it('checks required fields', function () {
    cy.get('.card-body input[name="en_name"]').clear();
    cy.get('.card-body input[name="ar_name"]').clear();
    cy.get('.card-body input[name="sap_code"]').clear();
    cy.get('.float-right > .btn-primary').click();
    cy.url().should('contain','/master-data/suppliers/1000/edit');
    cy.get('.error').should('contain','English Name is required')
    cy.contains('Arabic Name is required').should('be.visible');
    cy.contains('The sap code field is required.').should('be.visible');
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="en_name"]').clear().type('Alex');
    cy.get('input[name="is_active"]').invoke('attr', 'checked',false);
    cy.get('input[name="is_active"]').invoke('attr', 'value',0);
    cy.get('.card-body input[name="ar_name"]').clear().type('الاسكريه');
    cy.get('#items option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('.card-body input[name="sap_code"]').clear().type('7897');
    cy.get('.float-right > .btn-primary').click();
    cy.get('.text-center').should('contain','Supplier Updated Success')
    cy.server();
    cy.request('get','/api/supplier/Alex').then((response)=>{
      expect(response.body).to.have.property('en_name', 'Alex')
      expect(response.body).to.have.property('sap_code', '7897')
      expect(response.body).to.have.property('ar_name','الاسكريه')
      expect(response.body).to.have.property('is_active', 0)
      expect(response.body.items[0]).to.have.property('id', 10001)
    });
  })
  it('checks edit permissions',function(){
    cy.exec("php artisan user:remove_permission suppliers.edit");
    cy.visit('/master-data/suppliers');
    cy.get('tr > :nth-child(4) > .btn').should('not.exist');
    cy.visit('/master-data/suppliers/1000/edit',{ failOnStatusCode: false});
    cy.exec("php artisan user:remove_permission suppliers.index");

    cy.visit('/master-data/suppliers',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
