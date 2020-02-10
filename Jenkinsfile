pipeline{
	agent any{
		stages{
			stage('Init'){
				steps{
					echo 'This is my first Pipeline setup'
				}
			}
			stage('Build'){
				steps{
					input('Do you want to continue?')
				}
			}
		}
	}
}
