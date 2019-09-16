describe('Edit Users test', function () {
    before(function(){
      cy.exec('php artisan user:setLocale en');
    });
    beforeEach(function () {
        cy.exec('php artisan user:add_permission users.index');
        cy.exec('php artisan user:add_permission users.edit');
        cy.visit('http://127.0.0.1:8000/');
        cy.wait(2000);
        cy.url().should('contain', '/login');
        cy.get(':nth-child(2) > .form-control').type('test');
        cy.get(':nth-child(3) > .form-control').type('123456');
        cy.contains('Sign In').click();
        cy.wait(2000);
        cy.url().should('eq', 'http://127.0.0.1:8000/');
        cy.exec('php artisan test:delete_user');
        cy.exec('php artisan test:create_user');
        cy.exec('php artisan test:delete_user2');
    })
    it('check nullable values', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('input[name="employee_code"]').clear();
        cy.get('input[name="email"]').clear();
        cy.get('select[name=role_id]').select('Select Role');
        cy.contains('Save').click();
        cy.contains('User Updated Success').should('be.visible');
    })

    it('check default inactive status', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('.custom-switch-btn').should('have.css', 'border', '1px solid rgb(215, 215, 215)');
    })

    it('matching password confirmation', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('.card-body input[name=password]').type('123456');
        cy.get('.card-body input[name=password_confirmation]').type('123459');
        cy.contains('Save').click();
        cy.contains('password not matched').should('be.visible');
    })
    it('check password lenghth', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('.card-body input[name=password]').type('12345');
        cy.get('.card-body input[name=password_confirmation]').type('12345');
        cy.contains('Save').click();
        cy.contains('Password min length is 6').should('be.visible');
    })
    it('required fields check', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('input[name="full_name"]').should('have.attr', 'required');
        cy.get('input[name="user_name"]').should('have.attr', 'required');
    })
    it('default language check', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('select[name="lang"]').should('have.value', 'ar');
    })
    it('check user name length', function () {
        cy.contains('Master Data').click()
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
        cy.get('.card-body input[name=user_name]').clear().type('t');
        cy.contains('Save').click();
        console.log(cy.url())
        cy.contains('user name min length is 4').should('be.visible');
    })
    it('unique fields check', function () {
        cy.exec('php artisan test:create_user2');
        cy.contains('Master Data').click();
        cy.get('.sidebar-sub.sidebar-sub-users').click();
        cy.url().should('contain', '/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1001/edit']").click();
        cy.get('.card-body input[name=user_name]').clear().type('testing');
        cy.contains('Save').click();
        cy.contains('user name is duplicted').should('be.visible');
        cy.get('.card-body input[name=email]').clear().type('testing@test.com');
        cy.contains('Save').click();
        cy.contains('The email has already been taken.').should('be.visible');
        cy.exec('php artisan test:delete_user2');
    })

    it('checks passing nullable fields',function(){
      cy.contains('Master Data').click()
      cy.get('.sidebar-sub.sidebar-sub-users').click();
      cy.url().should('contain', '/master-data/users');
      cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
      cy.get('.card-body input[name="full_name"]').clear().type('Tonaguy');
      cy.get('.card-body input[name="user_name"]').clear().type('tonaguy');
      cy.get('.card-body input[name="password"]').clear().type('123456');
      cy.get('.card-body input[name="password_confirmation"]').clear().type('123456');
      cy.get('.card-body #role > option[value="2"]').invoke('attr', 'selected',true);
      cy.get('.card-body .btn-primary').click();
      cy.url().should('contain','/master-data/users');
      cy.get('.text-center').should('contain','User Updated Success')
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
      cy.contains('Master Data').click()
      cy.get('.sidebar-sub.sidebar-sub-users').click();
      cy.url().should('contain', '/master-data/users');
      cy.get("a[href='http://127.0.0.1:8000/master-data/users/1003/edit']").click();
      cy.get('.card-body input[name="full_name"]').clear().type('Tonaguy');
      cy.get('.card-body input[name="user_name"]').clear().type('tonagyy');
      cy.get('.card-body input[name="password"]').clear().type('123456');
      cy.get('.card-body input[name="password_confirmation"]').clear().type('123456');
      cy.get('.card-body input[name="email"]').clear().type('tonaguy@test.com');
      cy.get('.card-body #role > option[value=""]').invoke('attr', 'selected',true);
      cy.get('.card-body #inputState1 > option[value="dark"]').invoke('attr', 'selected',true);
      cy.get('.card-body #inputState2 > option[value="en"]').invoke('attr', 'selected',true);
      cy.get('.card-body #is_active').invoke('attr', 'value','1');
      cy.get('.card-body input[name="employee_code"]').clear().type(123);
      cy.get('.card-body .btn-primary').click();
      cy.url().should('contain','/master-data/users');
      cy.get('.text-center').should('contain','User Updated Successfully But User Has No Role.')
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
    after(function () {
        cy.exec('php artisan user:remove_permission users.edit');
        cy.visit('http://127.0.0.1:8000/master-data/users');
        cy.get("a[href='http://127.0.0.1:8000/master-data/users/1001/edit']").should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/users/1001/edit',{ failOnStatusCode: false});
        cy.get('.code').should('contain','403');
        cy.exec('php artisan user:remove_permission users.index');
        cy.get('.sidebar-sub-users').should('not.exist');
        cy.visit('http://127.0.0.1:8000/master-data/users',{ failOnStatusCode: false});
        cy.get('.code').should('contain','403');
        cy.visit('http://127.0.0.1:8000');
        cy.get('.user > button').click();
        cy.get('[href="javascript:void(0);"]').click();
        cy.url().should('contain', '/login');
        cy.exec('php artisan test:delete_user');
    })
})
