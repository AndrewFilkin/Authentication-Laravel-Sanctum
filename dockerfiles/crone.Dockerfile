# Use Alpine Linux as base image
FROM alpine:latest

# Install required packages
RUN apk --no-cache add bash

# Add your script to the container
COPY crontab/create_file.sh /create_file.sh

# Make the script executable
RUN chmod +x /create_file.sh

# Add crontab file
COPY crontab/crontab /etc/crontabs/root

# Run crontab
CMD ["crond", "-f"]