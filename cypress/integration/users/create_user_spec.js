beforeEach(function () {
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('admin')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click()
    cy.wait(2000);
    cy.visit('/master-data/users');
    cy.get('a > .btn').click();
    cy.wait(2000);
    cy.url().should('contain', '/master-data/users/create');
})
describe('Create user', function () {
    it('checks required fields', function () {
      cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
      cy.get('div.card-body > form').should('have.attr', 'noValidate','true');
      cy.get('.btn-primary').click();
      cy.wait(2000);
      cy.url().should('contain','/master-data/users/create');
      cy.get('.error').should('contain','The full name field is required.')
    })
    it('checks username minimum length',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('q');
      cy.get('input[name="password"]').type('Tonaguy');
      cy.get('input[name="password_confirmation"]').type('Tonaguy');
      cy.get('.btn-primary').click();
      cy.wait(2000);
      cy.url().should('contain','/master-data/users/create');
      cy.get('.error').should('contain','The user name must be at least 4 characters.')
    })
    it('checks password length',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('q');
      cy.get('input[name="password"]').type('123');
      cy.get('input[name="password_confirmation"]').type('123');
      cy.get('.btn-primary').click();
      cy.get('.error').should('contain','The password must be at least 6 characters.')
    })
    it('checks password match',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('q');
      cy.get('input[name="password"]').type('123');
      cy.get('input[name="password_confirmation"]').type('1234');
      cy.get('.btn-primary').click();
      cy.get('.error').should('contain','The password confirmation does not match.')
    })
    it('checks default theme',function(){
      cy.get('#inputState1 :selected').invoke('attr', 'value').should('contain', 'light')
    })
    it('checks unique email',function(){
      cy.get('input[name="email"]').type('admin@admin.com');
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('q');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('.btn-primary').click();
      cy.get('.error').should('contain','The email has already been taken.')
    })
    it('checks unique username',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('admin');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('.btn-primary').click();
      cy.get('.error').should('contain','The user name has already been taken.')
    })
    it('checks default language',function(){
      cy.get('#inputState2 :selected').invoke('attr', 'value').should('contain', 'ar')
    })
    it('checks unassigned role warning',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('tonaguy');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('#role > option[value=""]').invoke('attr', 'selected',true);
      cy.get('.btn-primary').click();
      cy.get('.warning').should('contain','The user has no role')
    })
    it('checks default inactive for no roles',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('tonaguy');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('#role > option[value=""]').invoke('attr', 'selected',true);
      cy.get('#is_active').invoke('attr', 'value','1');
      cy.get('.btn-primary').click();
    //  cy.get('.error').should('contain','The user name has already been taken.')
    })
    it('checks default avatar',function(){
      cy.get('#user-img').get('[src=""]').should('not.exist');
    })
    it('checks passing nullable fields',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('tonaguy');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('.btn-primary').click();
      cy.url().should('contain','/master-data/users');
    })
    it('checks all fields',function(){
      cy.get('input[name="full_name"]').type('Tonaguy');
      cy.get('input[name="user_name"]').type('tonaguy');
      cy.get('input[name="password"]').type('123456');
      cy.get('input[name="password_confirmation"]').type('123456');
      cy.get('input[name="employee_code"]').type(123);
      cy.get('.btn-primary').click();
      cy.url().should('contain','/master-data/users');
    })
})
