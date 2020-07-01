from django.urls import path
from .views import MovieView, BookView

urlpatterns = [
    path('getMovie', MovieView.as_view()),
    path('getBook', BookView.as_view())
]