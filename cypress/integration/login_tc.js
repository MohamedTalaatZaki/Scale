describe('login', function () {
  it('test login',()=>{
    cy.open_app_bb('/');
    cy.login_bb();
    cy.assert_success_login_bb();
    cy.login_out_bb();

    cy.login_bb('invalid user');
    cy.wait(2000);
    cy.assert_fail_login_bb();
  });
  it('checks user permission',function(){
    cy.open_app_bb('/');
    cy.login_bb();
    cy.assert_success_login_bb();
    cy.assert_user_url_permission_bb('item-types.index','/master-data/items/item-types');
  });

});
