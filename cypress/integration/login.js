beforeEach(function () {
    cy.visit('http://127.0.0.1:8000/');
    cy.wait(2000);
    cy.contains('Dashboards').click()
});

describe('check main menu links', function () {
    it('check dashboard link functionality- default', function () {
        cy.contains('Content').click();
        cy.url().should('contain', '/Dashboard.Content')
    })
    it('check dashboard link functionality - analytics', function () {
        cy.contains('Analytics').click();
        cy.url().should('contain', '/Dashboard.Analytics');
        cy.request('http://127.0.0.1:8000/Dashboard.Analytics.html').then(function(response){
            expect(response.status).to.eq(200);
        });
    });

    it('check dashboard link functionality- ecommerce', function () {
            cy.contains('Ecommerce').click()
            cy.url().should('contain', '/Dashboard.Ecommerce')
        }
    )
    it('check dashboard link functionality- content', function () {
        cy.contains('Content').click()
        cy.url().should('contain', '/Dashboard.Content')
    })
})


