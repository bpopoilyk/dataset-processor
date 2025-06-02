
# Dataset Processor API

A Symfony 7 service exposing one endpoint that:
1. Simulates a 10 s data fetch.
2. Caches results in Redis for 60 s.
3. Uses Redis lock to ensure only one fetch at a time; concurrent requests return 202 or stale cache.

---

## Prerequisites

- Docker & Docker Compose
- Free ports 8000 (API) and 6379 (Redis)

---

## Setup & Run

1. **Clone repo**
```bash
git clone https://github.com/your-username/dataset-processor.git
cd dataset-processor
```

2. **Create .env.local (gitignored) with:**
```bash
APP_ENV=dev
APP_SECRET=<64-char random hex>
LOCK_DSN=redis://dsp-redis:6379
CACHE_DSN=redis://dsp-redis:6379
```

3. **Build and start containers:**
```bash
docker-compose up --build -d
```

---

## Usage

API available at:
http://localhost:8000/process-huge-dataset

- First request: ~10s delay, returns dataset.
- Parallel requests during processing: HTTP 202.
- Subsequent requests within 60s: cached response.

---

## Testing Concurrency Manually

### Using Apache Bench
```bash
ab -n 10 -c 5 http://localhost:8000/process-huge-dataset
```
- Concurrency = 5: five simultaneous requests.
- Output: you should see one ~10 sec response (first acquires lock), others either ~0.2 sec (if cache already populated) or immediate 202 (if cache not yet written but stale not present).

### Using parallel curls
```bash
curl -i http://localhost:8000/process-huge-dataset &
curl -i http://localhost:8000/process-huge-dataset &
curl -i http://localhost:8000/process-huge-dataset &
```
- Only one process will sleep(10), others detect lock and return according to cache presence.
