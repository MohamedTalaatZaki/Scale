beforeEach(function () {
    cy.exec("php artisan user:add_permission arrived-trucks.index");
    cy.exec("php artisan user:add_permission transports.index");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#qualityControl"]').should('be.visible');
    cy.get('a[href="#qualityControl"]').click();
    cy.get('.sidebar-sub-arrived-trucks').click({ force: true });
    cy.visit('/qc/arrived-trucks');
    cy.get('.lab-btn > .btn').click();
    cy.url().should('contain','/qc/samples-test/1000/edit');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
    cy.exec('php artisan item_group:demo_faker');
    cy.exec('php artisan item:demo_faker');
    cy.exec('php artisan supplier:demo_faker');
    cy.exec('php artisan user:setLocale en');
    cy.exec('php artisan qc_test:fake_qc_details');
    cy.exec('php artisan test:create_truck_arrival');
    cy.exec('php artisan sample_test:create_sample_test');
});
describe('Create sample retest', function () {
  it('checks required fields', function () {
   cy.get('.btn-success').click();
   cy.get(':nth-child(1) > :nth-child(3) > [style="position: absolute"] > .notifyjs-wrapper > .notifyjs-container > .notifyjs-bootstrap-base').should('contain','Required')
  })
  it('checks rejected condition',function(){
    cy.get('input[name="details[0][sampled_range]"]').type(20);
    cy.get('select[name="details[1][sampled_expected_result]"] option[value="0"]').invoke('attr', 'selected',true);
    cy.get('select[name="details[1][sampled_expected_result]"]').trigger('change',{force:true});
    cy.wait(2000);
    cy.get('.text-danger').should('contain','Rejected')
    cy.get('.btn-rejected').should('be.visible')
    cy.get('.btn-success').should('be.visible')
    cy.get('.btn-rejected').click();
    cy.get('.swal2-confirm').should('be.visible').click();
    cy.get('#1000').closest('.card-body').should('contain','Rejected');
  })

  it('checks conditional acceptance', function () {
      cy.get('input[name="details[0][sampled_range]"]').clear().type(60);
      cy.get('select[name="details[1][sampled_expected_result]"] option[value="1"]').invoke('attr', 'selected',true);
      cy.get('select[name="details[1][sampled_expected_result]"]').trigger('change',{force:true});
      cy.wait(2000);
      cy.get('.text-danger').should('contain','Rejected')
      cy.get('.btn-rejected').should('be.visible')
      cy.get('.btn-success').should('be.visible')
      cy.get('.btn-success').click();
      cy.get('.swal2-confirm').should('be.visible').click();
      cy.get('.swal2-textarea').type('no reason',{force:true});
      cy.get('.swal2-confirm').click()
      cy.get('#1000').closest('.card-body').should('contain','Accepted');
      cy.visit('/security/transports');
      cy.get('#second-tab_').click();
      cy.get('tbody > tr > :nth-child(2)').should('contain','9999')
      cy.visit('/qc/arrived-trucks');
  })
  it('checks acceptance condition',function(){
      cy.get('input[name="details[0][sampled_range]"]').type(20);
      cy.get('select[name="details[1][sampled_expected_result]"] option[value="1"]').invoke('attr', 'selected',true);
      cy.get('select[name="details[1][sampled_expected_result]"]').trigger('change',{force:true});
      cy.wait(2000);
      cy.get('.text-success').should('contain','Accepted')
      cy.get('.btn-success').should('be.visible')
      cy.get('.btn-success').click();
      cy.get('.swal2-confirm').should('be.visible').click();
      cy.get('#1000').closest('.card-body').should('contain','Accepted');
      cy.visit('/security/transports');
      cy.get('#second-tab_').click();
      cy.get('tbody > tr > :nth-child(2)').should('contain','9999')
      cy.visit('/qc/arrived-trucks');
  })
  after(function(){
    cy.exec("php artisan user:remove_permission arrived-trucks.index");
    cy.exec("php artisan user:remove_permission transports.index");
    cy.visit('/qc/arrived-trucks',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/security/transports',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/qc/samples-test/1000/edit',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.visit('/');
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
