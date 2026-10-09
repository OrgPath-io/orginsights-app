FROM node:24-slim

# Install Chromium for PDF generation
RUN apt-get update && apt-get install -y \
    chromium \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY package*.json ./
RUN npm ci --only=production

COPY . .

RUN npm run build:client

ENV PORT=5000
ENV DATABASE_PATH=/app/data/app.db
ENV BLOB_DIR=/app/data/blobs

EXPOSE 5000

CMD ["npm", "start"]
