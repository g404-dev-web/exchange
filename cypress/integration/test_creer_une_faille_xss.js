describe('Test faille Xss', function () {
    it('Sign in', function () {
        cy.visit('http://localhost/exchange/public/login')

        //Rentrer ces identifiants
        cy.get('.login-text > input')
            .type('sirkayatest@test.test')
        cy.get('.login-password > input')
            .type('azerty')
        cy.get('.form-submit > .button').click()

        //Acceder au form pour poser une question
        cy.get('.navigation > ul > :nth-child(2) > a').click()

        //Poser une question

        cy.get('#question-title')
            .type('Ceci est un test automatisé')

        cy.get('#question-category')
            .select('js')

        cy.window().then((win) => {
            const simpleMDE = new win.SimpleMDE({element: win.document.querySelector("#question-details")});

            simpleMDE.value(
                "const name = \"<img src='x' onerror=' const elmt = document.getElementById(\"header\"); " +
                "elmt.style.backgroundColor = \"pink\"'>\"; el.innerHTML = name;"
            )

            cy.contains('Publiez votre question!').click()

            cy.get('#header').should('have.attr', 'style', 'background-color: pink;')
        })
    })

})
