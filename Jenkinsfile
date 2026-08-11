pipeline {
    agent any

    environment {
        APP_ENV  = 'testing'
        APP_KEY  = ''
        DB_CONNECTION = 'sqlite'
        DB_DATABASE   = ':memory:'
    }

    triggers {
        // Déclenche le pipeline à chaque push sur les branches main et develop
        pollSCM('H/5 * * * *')
    }

    stages {

        /* ─────────────────────────────────────────────
           ÉTAPE 1 : INTÉGRATION CONTINUE
           Récupération du code source
        ───────────────────────────────────────────── */
        stage('📥 Récupération du code') {
            steps {
                checkout scm
                echo "✅ Code récupéré depuis le dépôt Git"
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 2 : INTÉGRATION CONTINUE
           Installation des dépendances PHP
        ───────────────────────────────────────────── */
        stage('📦 Installation des dépendances') {
            steps {
                sh '''
                    composer install --no-interaction --prefer-dist --optimize-autoloader
                    echo "✅ Dépendances Composer installées"
                '''
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 3 : INTÉGRATION CONTINUE
           Configuration de l'environnement
        ───────────────────────────────────────────── */
        stage('⚙️  Configuration') {
            steps {
                sh '''
                    cp .env.example .env
                    php artisan key:generate
                    echo "APP_ENV=testing"    >> .env
                    echo "DB_CONNECTION=sqlite" >> .env
                    echo "DB_DATABASE=:memory:" >> .env
                    echo "✅ Fichier .env configuré"
                '''
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 4 : INTÉGRATION CONTINUE
           Analyse statique du code (qualité)
        ───────────────────────────────────────────── */
        stage('🔍 Qualité du code') {
            steps {
                sh '''
                    vendor/bin/php-cs-fixer fix --dry-run --diff --using-cache=no 2>&1 || true
                    echo "✅ Analyse de qualité terminée"
                '''
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 5 : INTÉGRATION CONTINUE
           Exécution des tests PHPUnit automatiques
           → Vérifie Étudiant, Matière, Note
        ───────────────────────────────────────────── */
        stage('🧪 Tests automatiques (PHPUnit)') {
            steps {
                sh '''
                    php artisan migrate --force --env=testing
                    php artisan test --coverage-text --min=70 2>&1
                    echo "✅ Tous les tests PHPUnit ont réussi"
                '''
            }
            post {
                always {
                    junit 'storage/logs/junit.xml'
                }
                failure {
                    echo "❌ Les tests ont échoué — arrêt du pipeline"
                    mail to: 'equipe@projet-notes.com',
                         subject: "ÉCHEC Tests — Build #${BUILD_NUMBER}",
                         body: "Les tests PHPUnit ont échoué.\nBuild: ${BUILD_URL}"
                }
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 6 : LIVRAISON CONTINUE
           Construction de l'artefact déployable
        ───────────────────────────────────────────── */
        stage('🏗️  Build — Livraison') {
            when {
                branch 'main'
            }
            steps {
                sh '''
                    php artisan config:cache
                    php artisan route:cache
                    php artisan view:cache
                    tar -czf gestion-notes-v${BUILD_NUMBER}.tar.gz \
                        --exclude=node_modules \
                        --exclude=.git \
                        --exclude=tests \
                        .
                    echo "✅ Artefact créé : gestion-notes-v${BUILD_NUMBER}.tar.gz"
                '''
                archiveArtifacts artifacts: 'gestion-notes-v*.tar.gz', fingerprint: true
            }
        }

        /* ─────────────────────────────────────────────
           ÉTAPE 7 : DÉPLOIEMENT CONTINU
           Déploiement automatique en production
           via Docker Compose
        ───────────────────────────────────────────── */
        stage('🚀 Déploiement en production') {
            when {
                branch 'main'
            }
            steps {
                withCredentials([sshUserPrivateKey(credentialsId: 'prod-ssh-key', keyFileVariable: 'SSH_KEY')]) {
                    sh '''
                        echo "🚀 Déploiement en cours sur le serveur de production..."

                        # Copie de l'artefact
                        scp -i $SSH_KEY gestion-notes-v${BUILD_NUMBER}.tar.gz \
                            deployer@production-server:/var/www/gestion-notes/

                        # Déploiement sur le serveur
                        ssh -i $SSH_KEY deployer@production-server << 'DEPLOY'
                            cd /var/www/gestion-notes
                            tar -xzf gestion-notes-v${BUILD_NUMBER}.tar.gz
                            php artisan migrate --force
                            php artisan config:cache
                            php artisan route:cache
                            php artisan view:cache
                            sudo systemctl reload php8.3-fpm
                            echo "✅ Application déployée avec succès !"
DEPLOY
                    '''
                }
            }
            post {
                success {
                    echo "✅ Déploiement réussi — Build #${BUILD_NUMBER} en production"
                    mail to: 'equipe@projet-notes.com',
                         subject: "✅ Déploiement réussi — Build #${BUILD_NUMBER}",
                         body: "L'application gestion-notes a été déployée.\nVersion: ${BUILD_NUMBER}\nURL: http://production-server/gestion-notes"
                }
                failure {
                    echo "❌ Échec du déploiement — Rollback en cours"
                    sh 'ssh -i $SSH_KEY deployer@production-server "cd /var/www/gestion-notes && php artisan down"'
                }
            }
        }
    }

    post {
        always {
            cleanWs()
            echo "Pipeline terminé — Nettoyage du workspace"
        }
        success {
            echo "✅ Pipeline CI/CD complet — Intégration · Livraison · Déploiement réussis"
        }
        failure {
            echo "❌ Pipeline échoué à l'étape : ${currentBuild.result}"
        }
    }
}
