# docker system prune -af --volumes
# Prune unused Docker objects
# To stop all containers:
​
# Stop all containers
docker container stop $(docker container ls -aq)
# Remove all containers
docker container rm $(docker container ls -aq)
# # Prune containers
# docker container prune
​
# Prune images
docker image prune
# Remove all images
docker rmi $(docker images -a -q)
​
# Prune volumes
docker volume prune
# Remove all volumes
docker volume rm $(docker volume ls -q)
​
# Prune networks
docker network prune
# Remove all networks
docker network rm `docker network ls -q`
​
# Prune everything To also prune volumes
docker system prune -af --volumes
​
# Your installation should now be all fresh and clean.
​
# The following commands should not output any items:
# The following commands show only show the default networks:
# docker ps -a
# docker images -a 
# docker volume ls
# docker network ls
​
​
​
​
​
​
# # docker container stop $(docker container ls -aq)
# # To stop clean containers:
# docker container rm $(docker container ls -aq)
# docker container rm $(docker ps -a -f status=exited -f status=created -q)
​
# # To clean networks:
# docker network rm $(docker network ls)