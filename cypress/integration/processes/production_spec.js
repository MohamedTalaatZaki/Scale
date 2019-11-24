beforeEach(function () {
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#production"]').should('be.visible');
    cy.get('a[href="#production"]').click();
    cy.get('.sidebar-sub-production-process').click({ force: true });
    cy.visit('/production/production-process');
    cy.get('button[data-target="#startModal"]').click({force:true});
    cy.get("#startModal button.close[data-dismiss='modal']").should(
      'be.visible'
    )
    cy.wait(2000);
    cy.get('div.modal-content > form').invoke('attr', 'noValidate','true');
})
before(function(){
    cy.exec("php artisan user:add_permission production-process.index");
    cy.exec("php artisan user:add_permission startProcess");
    cy.exec("php artisan user:add_permission finishProcess");
    cy.exec("php artisan user:add_permission transferLine");
    cy.exec("php artisan user:add_permission transports.index");
    cy.exec('php artisan item_group:demo_faker');
    cy.exec('php artisan item:demo_faker');
    cy.exec('php artisan supplier:demo_faker');
    cy.exec('php artisan user:setLocale en');
    cy.exec('php artisan qc_test:fake_qc_details');
    cy.exec('php artisan test:create_truck_arrival');
    cy.exec('php artisan sample_test:create_sample_test');
    cy.exec('php artisan truck_transports:update_status in_process');
    cy.exec('php artisan production:started_weight');
});
describe('Start/End Production process', function () {
  it.only('checks required fields', function () {
    cy.get('.btn-group-sm > .btn-primary').should('be.visible').click()
    cy.get('.alert').should('contain','The item id field is required.')
    cy.get('.alert').should('contain','The batch num field is required.')
    cy.get('.alert').should('contain','The line id field is required.')
  })
  it('checks batch number condition',function(){
    cy.get('input[name="batch_num"]').type(20);
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.get('.alert').should('contain','batch number min length is 4')
  })
  it('checks ends process condition',function(){
      cy.get('#lineSelect option[value="1"]').invoke('attr', 'selected',true);
      cy.wait(4000);
      cy.get('#itemsGroupSelect option[value="10001"]').invoke('attr', 'selected',true);
      cy.get('#itemsGroupSelect').trigger('change',{force:true});
      cy.wait(9000);
      cy.get('#itemsSelect option[value="1000"]').invoke('attr', 'selected',true);
      cy.get('input[name="batch_num"]').type(200);
      cy.get('.btn-group-sm > .btn-primary').click();
      cy.get('.finishBtn').click({force:true});
      cy.wait(4000);
      cy.get('#discount_percent').type(-10);
      cy.contains('Save').click();
      cy.get('.alert').should('contain','The discount percent min is 0')
      cy.get('.finishBtn').click({force:true});
      cy.wait(4000);
      cy.get('#discount_percent').type(200);
      cy.contains('Save').click();
      cy.get('.finishBtn').should('not.exist');
      cy.visit('/security/transports')
      cy.get('#third-tab_').click()
      cy.get('tbody > tr > :nth-child(2)').should('contain','9999')
      cy.visit('/production/production-process');
  })
  it('checks transfered condition',function(){
    cy.get('#lineSelect option[value="1"]').invoke('attr', 'selected',true);
    cy.wait(4000);
    cy.get('#itemsGroupSelect option[value="10001"]').invoke('attr', 'selected',true);
    cy.get('#itemsGroupSelect').trigger('change',{force:true});
    cy.wait(4000);
    cy.get('#itemsSelect option[value="1000"]').invoke('attr', 'selected',true);
    cy.get('input[name="batch_num"]').type(200);
    cy.get('.btn-group-sm > .btn-primary').click();
    cy.get('.btn-danger')
    cy.get('.finishBtn').should('not.exist');
    cy.visit('/');
  })
  after(function(){
    cy.exec("php artisan user:remove_permission production-process.index");
    cy.exec("php artisan user:remove_permission startProcess");
    cy.exec("php artisan user:remove_permission finishProcess");
    cy.exec("php artisan user:remove_permission transferLine");
    cy.exec("php artisan user:remove_permission transports.index");
    cy.visit('/production/production-process',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/');
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
