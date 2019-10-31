describe('login', function () {
   cy.open_app_bb();
   cy.login_bb();
   cy.assert_success_login_bb();
   cy.login_out_bb();

   cy.login_bb('invalid user');
   cy.assert_fail_login_bb();

});