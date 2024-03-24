# app/main.py
from fastapi import FastAPI
from routes.test import router as test_router

from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.post("/fetch-urls")
def fetch_urls():
   return{
       "status": "success",
       "message":"Data has been Fetched.",
       "urls": [] 
} 

app.include_router(test_router, prefix="/test", tags=["test"])


@app.get("/")
async def root():
    return {"message": "Hello World"}
