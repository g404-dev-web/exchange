describe('Registration Exchange', function() {
    it('Visit the site exchange', function() {
        cy.visit('http://localhost/exchange/public/')
        cy.contains('Bienvenue sur Exchange.Simplon')
    })
    it('Create an account', function() {
        cy.visit('http://localhost/exchange/public/login')

        // Acceder à la page de registration
        cy.contains('Create an account').click()
        // Creation d'un compte

        const randomNumber = Math.round(Math.random()*10000);
        // Username random
        cy.get('.form-inputs > :nth-child(1) > input')
            .type('SirKayaTest'+randomNumber+'')
        // Email random
        cy.get('.form-inputs > :nth-child(2) > input')
            .type('SirKayaTest'+randomNumber+'@test.test')
        // Password
        cy.get('.form-inputs > :nth-child(3) > input')
            .type('azerty')
            //Verification si le texte à bien était rentré
            .should('have.value', 'azerty')
        // Confirm password
        cy.get('.form-inputs > :nth-child(4) > input')
            .type('azerty')
            //Verification si le texte à bien était rentré
            .should('have.value', 'azerty')
        // Envoi du formulaire
        cy.get('.button').click()
    })

})
