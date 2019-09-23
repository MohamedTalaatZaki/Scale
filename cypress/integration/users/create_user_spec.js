beforeEach(function () {
    cy.exec("php artisan user:add_permission users.index");
    cy.exec("php artisan user:add_permission users.create");
    cy.visit('/');
    cy.wait(2000);
    cy.url().should('contain', '/login');
    cy.get(':nth-child(2) > .form-control').type('test')
    cy.get(':nth-child(3) > .form-control').type('123456')
    cy.contains('Sign In').click();
    cy.get('a[href="#masterData"]').should('be.visible');
    cy.get('a[href="#masterData"]').click();
    cy.get('.sidebar-sub-users').click({ force: true });
    cy.url().should('contain','/master-data/users');
    cy.get('.text-zero > a > .btn').click();
    cy.url().should('contain', '/master-data/users/create');
    cy.get('div.card-body > form').invoke('attr', 'noValidate','true');
})
before(function(){
  cy.exec('php artisan user:setLocale en');
});
describe('Create user', function () {
  it('checks required fields', function () {
    cy.get('div.card-body > form').should('have.attr', 'noValidate','true');
    cy.get('.card-body .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/users/create');
    cy.get('.error').should('contain','Full name is required')
  })
  it('checks username minimum length',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('q');
    cy.get('.card-body input[name="password"]').type('Tonaguy');
    cy.get('.card-body input[name="password_confirmation"]').type('Tonaguy');
    cy.get('.card-body .btn-primary').click();
    cy.wait(2000);
    cy.url().should('contain','/master-data/users/create');
    cy.get('.error').should('contain','user name min length is 4')
  })
  it('checks password length',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('q');
    cy.get('.card-body input[name="password"]').type('123');
    cy.get('.card-body input[name="password_confirmation"]').type('123');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','Password min length is 6')
  })
  it('checks password match',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('q');
    cy.get('.card-body input[name="password"]').type('123');
    cy.get('.card-body input[name="password_confirmation"]').type('1234');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','password not matched')
  })
  it('checks default theme',function(){
    cy.get('.card-body #inputState1 :selected').invoke('attr', 'value').should('contain', 'light')
  })
  it('checks unique email',function(){
    cy.get('.card-body input[name="email"]').type('admin@admin.com');
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('q');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','The email has already been taken.')
  })
  it('checks unique username',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('admin');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body .btn-primary').click();
    cy.get('.error').should('contain','user name is duplicted')
  })
  it('checks default language',function(){
    cy.get('#inputState2 :selected').invoke('attr', 'value').should('contain', 'ar')
  })
  it('checks unassigned role warning',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('useruser');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body #role > option[value=""]').invoke('attr', 'selected',true);
    cy.get('.card-body .btn-primary').click();
    cy.get('.text-center').should('contain','User Created Successfully But User Has No Role.')
  })
  it('checks default inactive for no roles',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('username');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body #role > option[value=""]').invoke('attr', 'selected',true);
    cy.get('.card-body #is_active').invoke('attr', 'value','1');
    cy.get('.card-body .btn-primary').click();
  })
  it('checks default avatar',function(){
    cy.get('.card-body #user-img').get('[src=""]').should('not.exist');
  })
  it('checks passing nullable fields',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('tonaguy');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body #role > option[value="2"]').invoke('attr', 'selected',true);
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/users');
    cy.get('.text-center').should('contain','User Created Success')
    cy.server();
    cy.request('get','/api/user/tonaguy').then((response)=>{
      expect(response.body).to.have.property('full_name', 'Tonaguy')
      expect(response.body).to.have.property('user_name', 'tonaguy')
      expect(response.body).to.have.property('is_active', false)
      expect(response.body).to.have.property('theme', 'light')
      expect(response.body).to.have.property('lang', 'ar')
      expect(response.body.roles[0]).to.have.property('id', 2)
    });
  })
  it('checks all fields',function(){
    cy.get('.card-body input[name="full_name"]').type('Tonaguy');
    cy.get('.card-body input[name="user_name"]').type('tonagyy');
    cy.get('.card-body input[name="password"]').type('123456');
    cy.get('.card-body input[name="password_confirmation"]').type('123456');
    cy.get('.card-body input[name="email"]').type('tonaguy@test.com');
    cy.get('.card-body #role > option[value=""]').invoke('attr', 'selected',true);
    cy.get('.card-body #inputState1 > option[value="dark"]').invoke('attr', 'selected',true);
    cy.get('.card-body #inputState2 > option[value="en"]').invoke('attr', 'selected',true);
    cy.get('.card-body #is_active').invoke('attr', 'value','1');
    cy.get('.card-body input[name="employee_code"]').type(123);
    cy.get('.card-body .btn-primary').click();
    cy.url().should('contain','/master-data/users');
    cy.get('.text-center').should('contain','User Created Successfully But User Has No Role.')
    cy.server();
    cy.request('get','/api/user/tonagyy').then((response)=>{
      console.log(response.body);
      expect(response.body).to.have.property('full_name', 'Tonaguy')
      expect(response.body).to.have.property('user_name', 'tonagyy')
      expect(response.body).to.have.property('employee_code', '123')
      expect(response.body).to.have.property('email', 'tonaguy@test.com')
      expect(response.body).to.have.property('is_active', false)
      expect(response.body).to.have.property('theme', 'dark')
      expect(response.body).to.have.property('lang', 'en')
    });
  })
  it('checks create permissions',function(){
    cy.exec("php artisan user:remove_permission users.create");
    cy.visit('/master-data/users');
    cy.get('.button-container > a > button').should('not.exist');
    cy.visit('/master-data/users/create',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
    cy.exec("php artisan user:remove_permission users.index");
    cy.visit('/master-data/users',{ failOnStatusCode: false});
    cy.get('.code').should('contain','403')
  });
  after(function(){
    cy.exec("php artisan migrate:refresh && php artisan db:seed");
  });
})
