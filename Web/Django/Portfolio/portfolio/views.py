from django.shortcuts import render

# Create your views here.
def indexView(request):
    return render(request, 'portfolio.html', {'app_name':'<UrDev/-/v/|==>'})