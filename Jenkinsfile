pipeline {
    agent any

    environment {
        AWS_REGION = 'us-west-2'
        ECR_REPO = '820440427786.dkr.ecr.us-west-2.amazonaws.com/php-3tier-app'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Docker Build') {
            steps {
                sh 'docker build -t php-3tier-app:latest .'
            }
        }

        stage('ECR Login and Push') {
            steps {
                sh '''
                    aws ecr get-login-password --region "$AWS_REGION" | \
                    docker login --username AWS --password-stdin "$ECR_REPO"

                    docker tag php-3tier-app:latest "$ECR_REPO:latest"
                    docker push "$ECR_REPO:latest"
                '''
            }
        }

        stage('Update ECR Pull Secret') {
            steps {
                sh '''
                    kubectl create secret docker-registry ecr-secret \
                      --docker-server="$ECR_REPO" \
                      --docker-username=AWS \
                      --docker-password="$(aws ecr get-login-password --region "$AWS_REGION")" \
                      --dry-run=client -o yaml | kubectl apply -f -
                '''
            }
        }

        stage('Helm Deploy') {
            steps {
                sh 'helm upgrade --install php-app helm/php-app'
            }
        }

        stage('Verify Deployment') {
            steps {
                sh 'kubectl rollout status deployment/php-app --timeout=180s'
            }
        }
    }
}
